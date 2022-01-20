@extends('template')

@section('content')

<div class="about-container">

    <section class="about-card">
        <span class="about-card-span"></span>
        <div>
            <h2 class="medallion-title">Qui suis-je ?</h2>
            <button class="bouton about-download"><a href="../documents/cv_ambroise.pdf" target="_blank">Télécharger mon CV !</a></button>
        </div>
        <img src="../img/portrait.png" alt="portrait" class="about-img"/>
    </section>
    
    <section class="teaching">
        <h3>D'une expérience dans l'enseignement...</h3>
        <div class="teaching-header">
            <img src="../img/teacher-shadow.png" alt="teacher-shadow" class="teacher-shadow"/>
            <div>
                <p>Fort de 4 années d'expérience dans l'Education Nationale, j'enseigne à présent à domicile au sein de l'entreprise Acadomia. Professeur d'histoire-géographie et d'anglais, je mets chaque jour mes connaissances et mon sens de la pédagogie au service de mes élèves pour les aider à réussir.</p>

                <p>En tant qu'enseignant, j'ai pu acquérir et renforcer de nombreux soft skills qui m'aident chaque jour dans ma vie professionnelle :</p>
                <ul class="soft-skills">
                    <li>Rigueur</li>
                    <li>Organisation</li>
                    <li>Aisance à l'oral</li>
                    <li>Etre à l'écoute</li>
                    <li>Travail en équipe</li>
                    <li>Capacité à me remettre en question</li>
                    <li>Volonté d'approfondir mes connaissances</li>
                    <li>Créativité</li>
                </ul>
            </div>
        </div>
        <div class="teaching-main">
            <div>
                <table>
                    <thead>
                        <tr>
                            <th colspan=2>Mon expérience professionnelle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Depuis 2018</td>
                            <td>Enseignant à domicile chez Acadomia<br/>en Anglais et Histoire-Géographie</td>
                        </tr>
                        <tr>
                            <td>2017 - 2018</td>
                            <td>Professeur d'Histoire-Géographie au collège Jules Lagneau de Metz</td>
                        </tr>
                        <tr>
                            <td>2016 - 2017</td>
                            <td>Professeur d'Histoire-Géographie au lycée Stanislas de Villers-les-Nancy</td>
                        </tr>
                        <tr>
                            <td>2015 - 2016</td>
                            <td>Professeur d'Histoire-Géographie au lycée Arthur Varoquaux de Tomblaine</td>
                        </tr>
                        <tr>
                            <td>2013 - 2014</td>
                            <td>Professeur contractuel d'Histoire-Géographie au lycée Louis Bertrand de Briey</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="myskills-container">
                <h4>Des compétences variées</h4>
                <ul class="myskills">
                    <li>Préparer les cours et établir la progression pédagogique</li>
                    <li>Concevoir les exercices et évaluer les connaissances</li>
                    <li>Enseigner les savoirs fondamentaux</li>
                    <li>Développer une démarche pédagogique</li>
                    <li>Suivre et conseiller des élèves dans leur travail</li>
                    <li>Gestion et animation d'un groupe d'élèves</li>
                    <li>Intervenir auprès d'enfants en difficulté ou à handicap</li>
                    <li>Préparer et organiser la mise en place d'évènements pédagogiques</li>
                    <li>Animer des activités culturelles et artistiques</li>
                    <li>Contrôler l'application du règlement intérieur</li>
                    <li>Formation à distance</li>
                    <li>Maîtrise des suites bureautiques</li>
                    <li>Coordonner l'activité d'une équipe</li>
                </ul>
            </div>
        </div>
    </section>
    
    <section class="devweb">
        <h3>... au métier de Développeur Web</h3>
        
        <div class="devwebmain">
            <img src="../img/devweb-shadow.png" alt="devweb-shadow" class="devweb-shadow"/>
            <table>
                <thead>
                    <tr>
                        <th colspan=2>Une reconversion professionnelle bien engagée</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="2">Depuis 2021</td>
                        <td>Formation de Développeur Web fullstack en alternance à la 3W Academy <br/>
                            HTML5, CSS3, JavaScript, React, PhP, MySQL, Symfony</td>
                    </tr>
                    <tr>
                        <td>Développeur Web à la Sellerie des Nacres à Enchenberg (57415) <br/>
                            HTML5, CSS3, Bootstrap, Jquery, MySQL et Laravel 8</td>
                    </tr>
                    <tr>
                        <td>En 2020</td>
                        <td>Formation "bootcamp" de Développeur Web junior à la 3W Academy <br/>
                            HTML5, CSS3, Bootstrap, Javascript, VueJS, PhP, MySQL, Symfony</td>
                    </tr>
                    <tr>
                        <td>2018 - 2020</td>
                        <td>Apprentissage du Développement Web en autodidacte <br/>
                            HTML5, CSS3, JavaScript, PhP</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="devwebskills">
            <h4>Des compétences qui progressent quotidiennement</h4>
            
            <div class="devwebskills-container">
                <div id="showcase" class="cloud-items-container">
                    <img src="{{ asset('img/devweb-logo/html5-fond-blanc.png') }}" alt="html" class="cloud9-item devweb-logo"/>
                    <img src="{{ asset('img/devweb-logo/css3-fond-blanc.png') }}" alt="css" class="cloud9-item devweb-logo"/>
                    <img src="{{ asset('img/devweb-logo/js-logo.png') }}" alt="javascript" class="cloud9-item devweb-logo"/>
                    <img src="{{ asset('img/devweb-logo/jsjquery-blanc.png') }}" alt="jquery" class="cloud9-item devweb-logo"/>
                    <img src="{{ asset('img/devweb-logo/react-fond-blanc.png') }}" alt="reactjs" class="cloud9-item devweb-logo"/>
                    <img src="{{ asset('img/devweb-logo/laravel-fond-blanc.png') }}" alt="laravel" class="cloud9-item devweb-logo"/>
                    <img src="{{ asset('img/devweb-logo/symfony.png') }}" alt="symfony" class="cloud9-item devweb-logo"/>
                    <img src="{{ asset('img/devweb-logo/mysql.png') }}" alt="mysql" class="cloud9-item devweb-logo"/>
                </div>
                <div id="cloud-item-title" class="cloud-item-title"></div>
                <div class="cloud9-nav">
                    <button id="cloud9-button-left" class="bouton"><i class="fa fa-arrow-left"></i></button>
                    <button id="cloud9-button-right" class="bouton"><i class="fa fa-arrow-right"></i></button>
                </div>
            </div>
        </div>
    </section>
    
    <section class="about-footer">
        <h3>Mon profil vous intéresse ?</h3>
        <p>N'hésitez pas à me contacter ! Je suis actuellement <strong>à la recherche d'un emploi</strong> !</p>
        <p>Je dispose du <strong>permis B</strong>. Habitant à Nancy dans la <strong>région Grand Est</strong>, je suis prêt à me déplacer dans un rayon de 50km autour de mon domicile à l'aide de mon véhicule personnel, ou à effectuer un trajet d'une heure en transports en commun (train). Je suis également ouvert à toute opportunité d'embauche <strong>en télétravail</strong> !</p>
        <div class="about-contact">
            <button class="bouton"><a href="index.php?action=contact">Me contacter</a></button>
            <button class="bouton"><a href="documents/cv_ambroise.pdf">Télécharger mon CV</a></button>
        </div>
    </section>
</div>

@endsection

@section('scriptjs')
    <script type="text/javascript" src="{{ asset('js/plugin/jquery.cloud9carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/about.js') }}"></script>
@endsection