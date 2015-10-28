<?php 
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











?>