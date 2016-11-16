@extends('main')

@section('title', 'About')

@section('content')
<div class="row">
	<div class="col-md-12">
		<h2>Help</h2>
		<h4>
		<h3>Aplicatia este destinata in principal antrenorilor de sah.</h3>

		<h3>Din punct de vedere al accesului in aplicatie: </h3>
		<h4>Aplicatia este structurata pe 2 nivele importante: </h4>
		<h4>	- partea publica (guest) accesibila oricarui vizitator care intra pe site si nu este necesar sa 	fie inregistrat sau logat </h4>
		<h4>	- partea secure (auth) accesibila numai userilor inregistrati si logati. Drepturile fiecarui user 	  care se inregistreaza si se logheaza se stabilesc de catre administratorul aplicatiei.
		<hr>
		Exista 7 tipuri de useri (roluri):</h4>

		<h4>	-Guest:  de fapt nu este un rol anume, este oricine care intra pe site fara sa fie inregistrat ca user </h4>
	<hr>
	Cei 7 sint:
		<h4>	-Visitor:  permite numai vizulizare fara modificari (de obicei se acorda celor care vor sa vizualizeze toate optiunile aplicatiei dar fara posibilitatea de a interveni - este doar pentru documentare)</h4>
		<h4>	-Blogger:  permite editarea si intretinerea Blogului (postari, categorii, taguri, text, pozele blogului etc)</h4>
		<h4>	-Referee:  permite editarea si intretinerea Turneelor (adauga turnee, modifica, incarca fisiere cu rundele, incarca poze de turneu)</h4>
		<h4>	-Teacher:  permite editarea si intretinerea Cursurilor</h4>
		<h4>	-Student:  permite vizualizarea cursurilor si rezolvarea temei de casa</h4>
		<h4>	-Author:   permite toate drepturile de mai sus mai putin optiunea About me (Despre mine) si mai acordarea de roluri (se acorda de obicei unui unui user care se ocupa de intretinerea intregului site, dar nu poate acorda sau modifica drepturile altor useri)</h4>
		<h4>	-Admin:    acorda drepturi oricarui user inregistrat. De asemenea optiunea About me (Despre mine) este rezervata numai pentru Admin. Se recomanda sa existe doar un singur Admin (maximum 2) la nivel de site. </h4>
		<hr>
		<h4>	Un user nou inregistrat nu are nici un drept (va fi tot guest) decit dupa validarea lui de catre Admin. </h4>
		<hr>
		<h3>Din punct de vedere al bussiness-ului aplicatiei:</h3> 
		<h4>Aplicatia este structurata pe 3 sectiuni importante:</h4>
		<h3>	- BLOG -<h3> <h4> - este public pentru vizualizare - permite proprietarului aplicatiei (administrator, care trebuie sa aiba si rol de Blogger)  sau altui user cu drept de Blogger sa posteze ce doreste, articole, 		informatii sau ce considera necesar sa fie cunoscut de catre cei care intra pe site. Blogul are si seciune de comentarii</h4>
		<h3>	- TURNEE -<h3> <h4>- este public pentru vizualizare - Referee (sau alt user care are si rol de Referee) poste incarca turnee de sah sau 			concursuri care urmeaza sa aiba loc si care pot fi vizualizate de toti vizitatorii site-ului. Se pot face inscrieri online la turneu.</h4>

		<h3>	- CURSURI -<h3> <h4> - este securizat - aceasta sectiune este accesibila numai userilor inregistrati si logati (chiar si la vizualizare), adica vizitatorii site-ului nu au access nici macar pentru vizualizare. La 				inregistrare fiecare user trebuie sa aiba adresa email valida.				
				Teaccher-ul (sau alt user care are drept de Teacher) incarca cursurile care pot fi direct editate in pagina aplicatiei sau pot fi facute in prealabil in format pdf. Poate construi diagrame pe care le poate atasa cursului.
				Rezolvarea diagramelor de catre cursanti (Student) se poate face fie de pe cursul editat (care poate fi tiparit direct din browser) fie direct online, cursantul in acest caz trebuie sa reproduca secventa de mutari care a fost stabilita la constructia diagramei.</h4>



		</h4>

<h3>	Altele: </h3>
<h4>	Pagina principala apare cu ultimele 2 postari din blog. </h4>
<h4>	Pagina blog apare cu 3 postari pe pagina. </h4>
<h4>	Pagina turnee apare cu 7 turnee pe pagina. </h4>
	</div>
</div>
@endsection