<?php
/*
Template Name: Formulär test
*/
?>

<style>
<?php include 'base.css'; ?>
<?php include 'adopt.css'; ?>
</style>

<?php get_header(); ?>

<div class="adopt">
  <div class="row header no-description">
    <div class="column column--12 column__tablet--12 column__mobile--12">
      <h1>Lämna intresseanmälan</h1>
    </div>
  </div>

  <div class="row form-row">
    <div class="column column--12 column__tablet--12 column__mobile--12 form-column">
      <form name="adoption-interest">
        <!-- Callouts -->
        <div class="callout success hide">
          <h2>Intresseanmälan skickad!</h2>
          <p>Tack för att du vill adoptera ett djur från Smådjurschansen! Vi har mottagit din intresseanmälan och kommer att kontakta dig via mail så snart som möjligt.</p>
        </div>
        <div class="callout error hide">
          <h2>Något gick fel!</h2>
          <p>Formuläret kunde inte skickas. Kolla att du har fyllt i alla frågor och försök igen.</p>
        </div>

        <label>För- och efternamn
          <input type="text" id="name" name="name" required value="" />
          <div class="error-message hide">Vänligen ange både för- och efternamn</div>
        </label>

        <label>E-post
          <input type="email" id="email" name="email" required value="" />
          <div class="error-message hide">Vänligen ange din e-post adress</div>
        </label>

        <label>Telefon
          <input type="number" id="phone" name="phone" required value="" />
          <div class="error-message hide">Vänligen ange ditt telefonnummer</div>
        </label>

        <label>Postadress
          <input type="text" id="address" name="address" required value="" />
          <div class="error-message hide">Vänligen ange din postadress</div>
        </label>

        <label>Postnummer
          <input type="text" id="postnumber" name="postnumber" required value="" />
          <div class="error-message hide">Vänligen ange ditt postnummer</div>
        </label>

        <label>Ort
          <input type="text" id="city" name="city" required value="" />
          <div class="error-message hide">Vänligen ange din ort</div>
        </label>

        <label>Vad är namnet/namnen på de djur ni är intresserade av att adoptera?
          <input type="text" id="animal-name" name="animal-name" required value="" />
          <div class="error-message hide">Vänligen ange namnet/namn på det djur du vill adoptera</div>
        </label>

        <label>Hur ser familjen ut? Om barn finns, ange ålder
          <input type="text" id="family-situation" name="family-situation" required value="" />
          <div class="error-message hide">Vänligen fyll i hur familjen ser ut</div>
        </label>

        <label>Vilka djur finns idag i familjen? Beskriv dem
          <input type="text" id="animal-situation" name="animal-situation" required value="" />
          <div class="error-message hide">Vänligen ange om djur finns i hushållet</div>
        </label>

        <label>Om ni redan har en eller flera av det djurslaget ni tänkt adoptera, beskriv hur ni har tänkt utföra ihopsättningen
          <input type="text" id="animal-assemble" name="animal-assemble" required value="" />
          <div class="error-message hide">Vänligen ange hur ni tänkt utföra ihopsättning</div>
        </label>

        <label>Gäller endast intresseanmälan kanin: om ni inte redan har en eller flera kaniner hemma, hur ser era tankar ut kring att skaffa fler kaniner i framtiden?
          <input type="text" id="animal-bunny-friend" name="animal-bunny-friend" value="" />
        </label>

        <label>Beskriv så utförligt som möjligt hur djurets kost kommer se ut
          <input type="text" id="animal-food" name="animal-food" required value="" />
          <div class="error-message hide">Vänligen ange djurets kost hos er</div>
        </label>

        <label>Vilka egenskaper önskar ni hos djuret?
          <input type="text" id="animal-qualities" name="animal-qualities" required value="" />
          <div class="error-message hide">Vänligen ange vad för egenskaper ni önskar hos djuret</div>
        </label>

        <label>Beskriv hur djurets boende skulle se ut hos er
          <input type="text" id="animal-living" name="animal-living" required value="" />
          <div class="error-message hide">Vänligen ange hur djuret skulle bo hos er</div>
        </label>

        <label>Vem tar hand om djuret vid semester eller krissituation?
          <input type="text" id="animal-semester" name="animal-semester" required value="" />
          <div class="error-message hide">Vänligen ange vem som tar hand om djuret när ni inte är hemma/har möjlighet</div>
        </label>

        <label>Vill ni ta över djurets försäkring i Agria om sådan finnes? Om inte, har ni tänkt försäkra i annat bolag? Om inte, hur ser er plan ut i det fallet djuret skulle bli sjukt och kräva veterinärvård?
          <input type="text" id="animal-insurence" name="animal-insurence" required value="" />
          <div class="error-message hide">Vänligen ange hur ni tänker kring försäkring</div>
        </label>

        <div class="gdpr-info">
          <p>Genom att skicka detta formulär godkänner du att dina personuppgifter behandlas enligt våra <a href="/terms-and-conditions" target="_blank">användarvillkor</a> och <a href="/integritetspolicy" target="_blank">integritetspolicy</a>. Vi använder dina uppgifter för att kontakta dig angående din intresseanmälan.</p>
        </div>

        <div class="button-wrapper">
          <button type="submit" class="button primary">Skicka intresseanmälan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php get_footer(); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
  var ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";

  $(document).ready(function() {
    $('form[name="adoption-interest"]').on('submit', function(e) {
      e.preventDefault();
      send_form();
    });
    
    $('button[type="submit"]').on('click', function(e) {
      e.preventDefault();
      send_form();
    });
  });

  function send_form() {
    // Clear all previous field error messages only
    $('label .error-message').addClass('hide');
    
    // Get values
    let name = document.getElementById('name').value.trim();
    
    let email = document.getElementById('email').value.trim();
    let phone = document.getElementById('phone').value.trim();
    let address = document.getElementById('address').value.trim();
    let postnumber = document.getElementById('postnumber').value.trim();
    let city = document.getElementById('city').value.trim();
    let animalName = document.getElementById('animal-name').value.trim();
    let familySituation = document.getElementById('family-situation').value.trim();
    let animalSituation = document.getElementById('animal-situation').value.trim();
    let animalAssemble = document.getElementById('animal-assemble').value.trim();
    let animalBunnyFriend = document.getElementById('animal-bunny-friend').value.trim();
    let animalFood = document.getElementById('animal-food').value.trim();
    let animalQualities = document.getElementById('animal-qualities').value.trim();
    let animalLiving = document.getElementById('animal-living').value.trim();
    let animalSemester = document.getElementById('animal-semester').value.trim();
    let animalInsurence = document.getElementById('animal-insurence').value.trim();

    // Check required fields and show specific error messages
    let hasErrors = false;
    
    if (!name) {
      $('#name').closest('label').find('.error-message').removeClass('hide');
      hasErrors = true;
    }
    if (!email) {
      $('#email').closest('label').find('.error-message').removeClass('hide');
      hasErrors = true;
    }
    if (!phone) {
      $('#phone').closest('label').find('.error-message').removeClass('hide');
      hasErrors = true;
    }
    if (!address) {
      $('#address').closest('label').find('.error-message').removeClass('hide');
      hasErrors = true;
    }
    if (!postnumber) {
      $('#postnumber').closest('label').find('.error-message').removeClass('hide');
      hasErrors = true;
    }
    if (!city) {
      $('#city').closest('label').find('.error-message').removeClass('hide');
      hasErrors = true;
    }
    if (!animalName) {
      $('#animal-name').closest('label').find('.error-message').removeClass('hide');
      hasErrors = true;
    }
    if (!familySituation) {
      $('#family-situation').closest('label').find('.error-message').removeClass('hide');
      hasErrors = true;
    }
    if (!animalSituation) {
      $('#animal-situation').closest('label').find('.error-message').removeClass('hide');
      hasErrors = true;
    }
    if (!animalAssemble) {
      $('#animal-assemble').closest('label').find('.error-message').removeClass('hide');
      hasErrors = true;
    }
    if (!animalFood) {
      $('#animal-food').closest('label').find('.error-message').removeClass('hide');
      hasErrors = true;
    }
    if (!animalQualities) {
      $('#animal-qualities').closest('label').find('.error-message').removeClass('hide');
      hasErrors = true;
    }
    if (!animalLiving) {
      $('#animal-living').closest('label').find('.error-message').removeClass('hide');
      hasErrors = true;
    }
    if (!animalSemester) {
      $('#animal-semester').closest('label').find('.error-message').removeClass('hide');
      hasErrors = true;
    }
    if (!animalInsurence) {
      $('#animal-insurence').closest('label').find('.error-message').removeClass('hide');
      hasErrors = true;
    }
    
    if (hasErrors) {
      $('.callout.error').removeClass('hide');
      $('.callout.success').addClass('hide');
      $('.callout.error')[0].scrollIntoView({ behavior: 'smooth' });
      return;
    }

    // Send form
    var data = {
      'action': 'send_adoption_form',
      'security': '<?php echo wp_create_nonce("send_adoption_form"); ?>',
      'name': name,
      'email': email,
      'phone': phone,
      'address': address,
      'postnumber': postnumber,
      'city': city,
      'animal_name': animalName,
      'family_situation': familySituation,
      'animal_situation': animalSituation,
      'animal_assemble': animalAssemble,
      'animal_bunny_friend': animalBunnyFriend,
      'animal_food': animalFood,
      'animal_qualities': animalQualities,
      'animal_living': animalLiving,
      'animal_semester': animalSemester,
      'animal_insurence': animalInsurence
    };

    $.post(ajaxurl, data, function(response) {
      if (response.success) {
        $('.callout.error').addClass('hide');
        $('.callout.success').removeClass('hide');
        
        // Hide form labels, button and scroll to success message
        $('form[name="adoption-interest"] label').addClass('hide');
        $('form[name="adoption-interest"] .button-wrapper').addClass('hide');
        $('button[type="submit"]').addClass('hide');
        $('.callout.success')[0].scrollIntoView({ behavior: 'smooth' });
      } else {
        $('.callout.success').addClass('hide');
        $('.callout.error').removeClass('hide');
        
        // Handle specific server errors
        if (response.data && response.data.field) {
          // Show specific field error if provided by server
          $('#' + response.data.field).closest('label').find('.error-message').removeClass('hide');
        }
        
        // Scroll to error message
        $('.callout.error')[0].scrollIntoView({ behavior: 'smooth' });
      }
    }).fail(function() {
      $('.callout.success').addClass('hide');
      $('.callout.error').removeClass('hide');
      
      // Scroll to error message
      $('.callout.error')[0].scrollIntoView({ behavior: 'smooth' });
    });
  }
</script>