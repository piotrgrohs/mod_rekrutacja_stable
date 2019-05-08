<h1>Rejestracja: </h1>
<form action="" method="post">
  <div class="form-group">  
    <label for="email">Email: </label>
    <input type="email" class="form-control" name="login" id="email" aria-describedby="emailHelp" placeholder="kowalski@poczta.pl" required>
    <small id="emailHelp" class="form-text text-muted">Wpisz tutaj twój adres email.</small>
  </div>
  <!-- nazwa szkoly i do wyboru miejscowosc, 8-klasa czy gimnazjum -->
  <div class="form-group">
    <label for="password">Hasło: </label>
    <input type="password" class="form-control" name="password" id="password"  placeholder="*****" required>
  </div>
  <div class="form-group">
    <label for="schoolName">Nazwa szkoły i miejscowość: </label>
    <input type="text" class="form-control" name="schoolName" id="schoolName"  placeholder="Zespół szkoł techniczno-ekonomicznych">
  </div>
  <div class="form-group">
  <label for="tOfSchool">Kończysz: </label>
  <select class="form-control form-control" name="tOfSchool"> 
  <option>szkołę podstawową</option>
  <option>gimnazjum</option>
</select>
</div>
<div class="form-group">
<label for="schoolChoose">Interesuje mnie kształcenie w: </label>
<select class="form-control form-control" name="schoolChoose" id="schoolChoose" >
<option>wybierz</option>
  <option>ZST-E w Radzionkowie</option>
  <option>innej szkole</option>
</select>
</div>
<div class="form-group subSelect" style="display:none" id="tOfClass">
<label for="tOfClass">W zawodzie: </label>
<select class="form-control form-control" name="tOfClass">
  <option>technik elektryk</option>
  <option>technik eksploatacja portów i terminali</option>
  <option>technik hotelarstwa</option>
  <option>elektryk szkoła branżowa</option>
</select>
</div>

  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="rodoCheckBox" required>
    <label class="form-check-label" for="rodoCheckBox">Wyrażam zgodę na przetwarzanie danych osobowych mojego dziecka
     w zakresie imienia i nazwiska w celu udziału w konkursach „Dni otwartych” 
     14 maja 2019 roku w Zespole Szkół Techniczno-Ekonomicznych w Radzionkowie
      (w szczególności wyłonienia zwycięzców,
     ogłoszenia wyników i wręczenia nagród zwycięzcom).</label>
     <input type="checkbox" class="form-check-input" id="rodoCheckBox" required>
    <label class="form-check-label" for="rodoCheckBox">Wyrażam zgodę na wykonywanie zdjęć z  wizerunkiem mojego dziecka
     oraz rozpowszechnianie tych zdjęć na stronie internetowej szkoły oraz na szkolnym Facebooku przez 
    organizatorów „Dni otwartych” w Zespole Szkół Techniczno-Ekonomicznych w Radzionkowie.</label>
  <input type="checkbox" class="form-check-input" id="rodoCheckBox" required>
    <label class="form-check-label" for="rodoCheckBox">Wyrażam zgodę na opublikowanie danych zwycięzców konkursów
 „Dni otwartych” w Zespole Szkół Techniczno-Ekonomicznych w Radzionkowie, na stronie internetowej
  Organizatora oraz na szkolnym Facebooku. 
</label>
  <a href="https://zste.pl/images/stories/PDFy/dniotwarte/Zgoda_na_przetwarzanie_danych_osobowych.pdf">Zgoda na przetwarzanie danych osobowych</a>
  </div>
  </div>
  </br>
  <button type="submit" class="btn btn-primary">Zarejestruj</button>
</form>
<script>
  var passwordInput = document.getElementsByName("password");
  passwordInput[0].addEventListener('change', validPassword);
  var schoolChoose = document.getElementById("schoolChoose");
  schoolChoose.addEventListener('change', schoolChooseF);
  var tOfClass = document.getElementById("tOfClass");
function validPassword(){
  var password = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/;
  if(password.test(this.value)){
    passwordInput.classList.add("green");
  }
  else{
    passwordInput.classList.remove("green");
  }
}
function schoolChooseF(){
  if(schoolChoose.value.match(/zst-e/gi)){
    tOfClass.style.display = 'block';
  }else{
    tOfClass.style.display = 'none';
  }
}

</script>