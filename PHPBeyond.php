<?php 
	// NULL and empty

	// NULL znaci nista

	is_null(); // za null vrednost daje true, za prazan string false, za nepostojecu vrednost daje true i izbacuje notice
	isset(); // false za null, true za prazan string, false za nepostojecu vrednost

	// null je nepostojanje vrednosti

	// empty: "", null, 0, 0,0, "0", false, array()
	// empty: "", null, 0, 0,0, "0", false, array()

	// KASTOVANJE

	// dva nacina
	settype(var, type); // menja tip varijable odmah
	(integer) $var;		// mora da se dodeli novoj vrednosti da bi se promenio tip

	gettype(var);

	string
	int, integer
	float
	array
	bool, boolean

	continue; // kada se koristi u vise nivoa petlje, mozemo da stavimo broj pored continue(2), to znaci da se continue odnosi na stariju for petlju:

	for ($i=0; $i < 5; $i++) { 
		if ($i % 2 == 0) { continue; }
		for ($k=0; $k < 5; $k++) { 
			if ($k == 3) { continue(2); } // odlazi skroz do gornje petlje, prestaje da izvrsava ovu
			echo $i . "-" . $k . "<br>";
		}
	}

	break; // u for petlji predstavlja izlazak iz kompletne petlje

	break(2); // ima isto opciju kao i continue

	// POINTERI

	$ages = array(); // neki niz

	current($ages); // na koji trenutno pokazujemo
	next($ages);	// prebaci pokazivac na sledeci
	prev($ages);	// prebaci pokazivac na prethodni
	reset($ages);	// vrati na prvi
	end($ages);		// idi na poslednji, end pa next daje nista


	// koriscenje

	while ($age = current($ages)) { // dodeljivanje, nije poredjenje!!!
		echo $age . ", ";
		next($ages);
	} // bitno zbog rada sa bazama

	// kada imamo neku funkciju saberi_oduzmi() koja vraca niz sa, recimo, dve vrednosti, onda mozeom da ispisemo kao listu:

	list($zbir, $razlika) = saberi_oduzmi(20, 10); // ovako smestimo te dve vrednosti koje ce nam napuniti niz koji se vraca u listu, i onda mozemo da ih prikazemo 

	// DEBAGOVANJE

	// korisna funkcija koju upisujemo unutar neke funkcije

	var_dump(debug_backtrace());

	// LINKS AND URL's

	// postoje tri nacina na koje prikupljamo informacije od korisnika na internetu:

	//Links and URL's 	GET request
	//Forms 			POST request
	//Cookies			COOKIE

	// GET

	// super-globalna varijabla u kojoj se cuvaju podaci koje prosledimo preko url-a. Oni se smestaju u asocijativni niz iz kog mozemo da im pristupimo
	// npr. google.com/search=1&page=2

	$_GET['search']; // 1
	$_GET['page']; // 2

	// KODIRANJE GET VREDNOSTI (ako imamo nezeljene karaktere kao npr. &)

	// ima dosta karaktera koji su rezervisani u URL-u, zato moramo biti pazljivi !()@#$[]+%&*...
	// njih zamenjujemo sa znakom procenta i parom heksadecimalnih cifara (npr. %26 je &)

	urlencode($string); 	// rezervisani karakteri postaju % + 2 heksa cifre
							// space postaje +

	// koristi se samo za $_GET, ne i za $_POST i $_COOKIE jer tu nemamo smestanje vrednosti u URL

	rawurlencode($string); 	// rezervisani karakteri postaju % + 2 heksa cifre
							// space postaje %20 !!!!

	// Koji koristiti???

	// rawurlencode putanju pre ?
	// - space-ovi moraju biti interpretirani kao %20

	// urlencode query string posle ?
	// - space-ove je bolje enkodirati kao "+"

	// rawurlencode je generalno kompatibilniji !!!

	// KODIRANJE HTML-a

	// rezervisani karakteri < > & "

	// htmlspecialchars(string) - enkodira 4 specijalna karaktera u &lt; &gt; &amp; &quot;
	// htmlentities(string) - enkodira sve znakove koji imaju HTML ekvivalent

	// INCLUDE, REQUIRE

	// kad include-ujemo fajl, bitmoje da i on ima otvoren php tag

	// HEDERI

	// sluze za redirekcije

	header(string);

	// JAKO BITNO: oni se pojavljuju pre svog ostalog sadrzaja stranice !!!

	// REDIREKCIJE

	// jedan tip redirekcije je 302 redirekcija

	// HTTP 1.1/ 302 Found
	// Location: path // novi URL

	header("Location: login.php"); // mora tacno ovako da izgleda Location: lokacija


	// OUTPUT BUFFERING

	// kao slavina (php kod) koja puni casu (web server) HTML-om, kad upadne prva kap, dobijamo hedere, kad se casa napuni server salje podatke browseru
	// output buffer je kao posuda za merenje koja stalno salje istu "kolicinu" koda u casu, tako mozemo da editujemo hedere u toku "presipanja"
	// mozemo da ga podesimo u php.ini ili za svaki fajl posebno (recimo 4096, to je dobar broj)

	ob_start(); // pocetak (mora pre bilo kog sadrzaja, kao hederi)
	ob_end_flush(); // kraj

	// FORME!!!!

	// POST zahtev
	// kad submit-ujemo formu, ona moze da vodi na istu stranu ili na neku drugu, podaci iz forme se smestaju u $_POST kao acosijativni niz, koji ima key ono sto je nama name inputa, a value je vrednost tog polja.

	echo $_POST['$key'];

	// provera da li ima vrednosti u $_POST, tj. dali smo dosli preko forme na stranicu ili samo preko url-a
	// boolean_test ? value_if_true : value_if_false
	$username = (isset($_POST['username'])) ? $username : "" ;
	// provera da li je forma poslata
	if (isset($_POST['submit'])) {
		// zbog ovoga submit input mora da ima name="submit"
	}

	// FORMA I PROCESUIRANJE NA ISTOJ STRANI

	// dobro je ako imamo sve na istoj strani, i html i procesuiranje
	// lako mozemo da opet prikazemo formu sa podacima koje smo uneli kako bi ih ispravili ako ima gresaka

	// VALIDACIJA FORME
	// postoje razne validacije i jako su bitne
		// - validacija prisutnosti (da li je polje popunjeno)
		// - validacija duzine (max i min)
		// - tip (string, integer)
		// - da li je u setu vrednosti (male, female)
		// - jedinstvenost (username)
		// - format (datum)
		// - ...

	// * prisutnost
	$value = ""; // proslo bi samo isset
	if (!isset($value) || empty($value)) {
		echo "Validation failed!<br>";
	}

	// * duzina
	// minimalna duzina
	$value = "micamica"; // ne prolazi
	$min = 3;
	if (strlen($value) < $min) {
		echo "Validation failed!<br>";
	}
	// maximalna duzina
	$max = 5;
	if (strlen($value) > $max) {
		echo "Validation failed!<br>";
	}

	// * tip
	$value = 1; // ne prolazi
	// BITNO - kad citamo vrednosti iz forme, one su uvek stringovi i moramo da ih konvertujemo da bi bile u nekom drugom formatu
	if (!is_string($value)) {
		echo "Validation failed!<br>";
	}

	// * set vrednosti
	$value = "5"; // ne prolazi 
	$set = array("1", "2", "3", "4");
	if (!in_array($value, $set)) {
		echo "Validation failed!<br>";
	}

	// * jedinstvenost

	// treba nam baza

	// * format
	// koristimo regex nad stringom
	// preg_match(pattern, subject)
	if (preg_match("/PHP/", "PHP iz fun")) {
		echo "A match was found"; // tacno
	} else {
		echo "A match was not found";
	}

	$value = "nobody@nowhere.com";
	if (!preg_match("/@/", $value)) {
		echo "Validation failed!<br>";
	}

	// umesto toga moze i ovo
	if (strpos("@", $value) === false) { // mora === jer ako bi bilo == i @ na prvom mestu, tj. poziciju 0, to bi bilo tacno
		echo "Validation failed!<br>";
	}

	// LAZNE POZITIVNE VREDNOSTI

	// klip 069, ima ih brda...

	empty(); // ""; 0; "0"; false, null, array() su svi empty, posebno je cudan "0"... (broj dece u formi)

	// Mozemo da napravimo fajl za validacije
































	$a = "hello";
	$hello = "Hello svima!";
	
	// ispisuje $(sadrzaj $a), tj. $hello, tj. Hello svima!
	echo $$a;  
	
	// Sta znaci $$var[1]:
	// #1 nadji prvi element, pa onda odredi vrednost dinamicki
	// #2 odredi vrednosti dinamicki, pa uzmi prvi element

	// Da se ne bi zbunjivali, koristimo {}
	// echo ${$var[1]} za #1
	// echo ${$var}[1] za #2

	// ARRAY FUNCTIONS

	// shifts first element out of an array and returns it
	array_shift(array);

	// prepends an element to an array, returns elements count, 'first' is the value of the element
	$b = array_unshift($numbers, 'first');

	// pops last element out of an array and returns it
	$a = array_pop($numbers);

	// pushes the element onto the end of an array, returns elements count
	$b = array_push($numbers, 'last');  

	// DATES AND TIMES

	Epoch time/Unix timestamp - vreme proteklo od pocetka racunanja vremena u sekundama po php-u

	Nula predstavlja 1. januar 1970. u ponoc

	// pravljenje timestamp-a

	time(); // trenutno vreme (broj sekundi od 1970)
	mktime($hr, $min, $sec, $m, $d, $y); // napravimo vreme
	strtotime($any_string) // prebacuje string u vreme na najbolji nacin na koji ume npr 'now', '20 September 1980', 'last monday'
	checkdate(month, day, year) // proverava da li datum postoji

	// FORMATIRANJE DATUMA

	date();
	strftime();

	Moze da se koristi bilo koji od ova dva, Skoglund vise gotivi strftime();
	u dokumentaciji moze da se vidi kako da se napravi format koji odgovara zahtevima, to je smesno

	Posto strftime() nema opciju da prikaze mesec i dan bez nula, postoji hak:

	function strip_zeros_from_time($not_formated = '') {
		$no_zeros = str_replace('*0', '', $not_formated);
		$cleared_string = str_replace('*', '', $no_zeros);
		return $cleared_string;
	}

	echo strip_zeros_from_time(strftime('The time is *%m/*%d/%y', $timestamp));

	Format za mysql: strftime("%Y-%m-%d %H:%M:%S", $string); // 2015-10-13 20:17:11

	// SERVER AND REQUEST VARIABLES

	$_SERVER 	// 	mnostvo podataka 
				//	$_SERVER['SERVER_NAME']
				//	$_SERVER['SERVER_ADDR']
				//	$_SERVER['SERVER_PORT']
				//	$_SERVER['DOCUMENT_ROOT'] ...
	$_REQUEST	// ne koristiti, sve podatke mozemo da dobijemo preko $_POST i $_GET

	// VARIABLE SCOPE

	Varijable unutar php-a imaju global scope, varijable unutar funkcija imaju local scope
	static varijabla je lokalna varijabla funkciji, ali ne gubi svoju vrednost kada izadjemo iz funkcije

	u OOP postoji jos jedna funkcija reci static na koju treba obratiti paznju i dobro je znati ovo kao osnovu za to

	// REFERENCE ASSIGNMENT

	$a = 1;
	$b = $a;
	$b = 2;
	echo 'a:' . $a . ', b:' . $b . '<br>';
	// a:1, b:2

	$a = 1;
	$b =& $a; // reference assignment, kao precica na desktopu ka folderu, menjamo jedan, menja se drugi
	$b = 2;
	echo 'a:' . $a . ', b:' . $b . '<br>';
	// a:2, b:2

	ako obrisemo b, a ce ostati netaknuto

	unset($b);
	echo 'a:' . $a . ', b:' . $b . '<br>';
	// a: 2, b:

	// REFERENCA KAO ARGUMENT FUNKCIJE

	function ref_test(&$var){
		$var = $var * 2;
	}
	$a = 10;
	ref_test($a); // 20, da smo gore imali samo $var, bez &, onda bi rezultat bio 10, jer je $var nestaje kad se izvrsi funkcija

	// OOP - OBJEKTNO ORIJENTISANO PROGRAMIRANJE

	Zasnovano na objektima, objekti mogu imati funkcije i atribute

/*	Objekti su nam korisni za:

		- Ormanizovanje i odrzavanje koda
		- Smanjuje kompleksnost i bolje objasnjava stvari (mnogo lakse je da napravimo objekat student koji ce da ima funkcije i atribute)
		- Jednostavna pravila nam omogucavaju kompeksne interakcije
		- Stavlja akcenat na podatke, a ne na procedure (procedure su ugradjene u objekte)
		- Deljenje koda (podelimo kod na delove i onda mozemo da radimo na necemu, a da to ne utice ninasta drugo)
		- Konovno koriscenje koda
		- Objetki su odlicni za rad sa bazama (ako imamo objekad automobil, mozemo da imamo bazu automobili)
*/

	// DEFINISANJE KLASA

	class Student {
		// ovde idu atributi i metode
	} // velikim slovom, svaka sledeca rec prvo slovo veliko

	get_declared_classes() // ispisuje sve klase koje postoje
	if (class_exists(imeklase)) {} // da li klasa postoji

	// DEFINISANJE METODA KLASA

	metode su isto sto i funkcije, samo sto kada se deklarisu unutar klasa, onda su metode


	// INSTANCIRANJE KLASA

	new Person(); // kao da postavljamo prazan papir sa poljima za popunjavanje


	$person = new Person(); // instanciranje klase
	$person2 = new Person(); // dve razlicite instance klase Person

	if (is_a($person, 'Person')) // gledamo da li instanca pripada klasi, vraca true/false

	$person->metodaIzKlasePerson(); // pozivanje metode klase

	$this // referencira na instancu trenutne klase (znaci poziva se samo unutar klase)

	// VARIJABLE KLASE

	// varijable koje se pojavljuju u klasama se nazivaju properties ili attributes ili instance variables te klase
	// kada deklarisemo varijable unutar klase, moramo da koristimo var!
	// kada ih pozivamo, ne koristimo $ (jer bi to onda bila varijabilna varijabla), a ne koristimo ni ()
	$person->arm_count; // to je to

	// NASLEDJIVANJE KLASA

	definisemo jednu klasu, onda definisemo drugu klasu uz pomoc kljucne reci extends, i onda ona nasledjuje metode i varijable prve klase

	class CompactCar extends Car {}

	get_parent_class();
	is_subclass_of(object, class_name);

	// MODIFIKATORI PRISTUPA

	public // dostupno svuda, default
	private // samo unutar klase u kojoj se nalazi
	protected // malo slobodnije, iz ove klase ili njenih podklasa

	po defaultu kad koritimo var, to je kao da smo koristili public!

	public $a = 1;
	protected $b = 2;
	private $c = 3;

	// SETERI I GETERI

	class SetterGetterExample
	{
		private $a=1;

		public function get_a() { // GETTER
			return $this->a;
		}

		public function set_a($value) { // SETTER (primer banke)
			$this->a = $value;
		}
	}

	// STATIC


	class Student {
		static $total_students=0;

		static function welcome_students($var="Hello") {
			echo "{$var} students.";
		}
	}

	// ovako imamo pristup i varijabli $total_students i funkciji welcome_studenst cak iako nemamo instance

	POZIVANJE INSTANCE
	// $student = new Student();
	// echo $student->total_students;

	STATICKI POZIV
	echo Student::$total_students;

	SA STATICKIM METODAMA NE MOZEMO DA KORISTIMO $this!!!!!
	umesto toga koristimo self!!!

	static function add_student() {
		self::$total_students++;
	}

	// kada u nasledjivanju negde u klasama koje nasledjuju promenimo vrednost statickoj varijabli, njena vrednost se menja u svim klasama u kojima postoji!!!

	// SCOPE RESOLUTION OPERATOR 

	to su ove :: // paamayim nekudotayim ili dupla dvotacka

	// REFERENCIRANJE PARENT KLASE SA ::

	parent:: // kljucna rec
	// ono sto je najbitnije je da ovako mozemo da koristimo :: sa instancama, i ovo radi samo sa metodama parenta, ne i sa atributima
	// stoga mozemo da overrajdujemo parent metodu, ali da i dalje koristimo ono sto imamo sacuvano u njoj

	// KONSTRUKTORI I DESTRUKTORI KLASA

	// konstruktori su odlicni za inicijalizaciju svih objekata pre nego sto se on zapravo koristi

	class Table {
		function __construct(){ // moze da ima artibute
			// ovde inicijalizujemo sve pocetne vrednosti atributa funkcije Table
		}
	}

	// destruktori se jako retko koriste

	// KLONIRANJE (KOPIRANJE) OBJEKATA

	$b = clone $a; // sad nije referenca objekta $a, nego novi objekat

	function __clone() // konstruktor za kloniranje

	// UPOREDJIVANJE OBJEKATA

	uporedjivanje:	== 
	identicnost:	===

	$box === $box_reference; // ostali svi slucajevi su netacni

	$box == $box_reference;
	$box == $box_clone;
	$box == $another_box; // sve tacno, samo ako promenimo vrednost atributa, nece biti tacno

	// RAD SA FAJLOVIMA

	echo __FILE__ // daje nam putanju do trenutnog fajla
	echo __LINE__ // daje nam liniju fajla koje trenutno gledamo, treba da pazimo na inkludovane fajlove, jer onda ovo ne mora da bude tacno
	echo dirname(__FILE__) // direktorijum u kome je fajl
	echo __DIR__ // ista stvar od PHP-a v5.3

	file_exists(filename) // da li postoji fajl (moze i za dokument)

	is_file(filename) // da li je fajl ili direktorijum

	is_dir(filename) // da li je direktorijum

	is_dir('..')

	// PERMISIJE

	// generalno treba davati sto manje permisija, tj. omoguciti samo one koje treba da stavimo da bismo uradili ono sto zelimo

	// u sustini, postoje tri kategorije korisnika: user, group, other

	// i tri pita akcija nad fajlom/folderom read(R), write(W), execute(X) (execute je islistavanje fajlova u direktorijumu, ili da pokrenemo fajl)

	// i onda imamo dve vrste prikaza: simbolicki i oktalni(numericki)

	// npr: rwxrw-r-- (- znaci ne moze ta operacija)

	// u oktalnom sistemu r = 4, w = 2, x = 1, - = 0 (rwx = 7, rw = 6, r = 4, rx = 5 ...)


	// who am I, who is the owner, who is the web server?
	// often Nobody, or sometimes WWW, Apache

	// chown i chmod (poznato)




?>