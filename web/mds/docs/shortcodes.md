###Qu'est-ce qu'un shortcode

lorem ipsum

###Shortcodes utilisables

- [link](#link)
- [img](#img)
- [youtube](#youtube)

####link <a name="link"></a>

__[link url="-adresse-"]-texte-[/link]__

Ou -adresse- est l'url absolue ou relative et -texte- le texte à afficher dans la page ( pas de html )

__[link route="-nom_de_la_route-"]-texte-[/link]__

Ou -nom\_de\_la\_route- est le nom de la route qui sera transformé en url absolue en interne et -texte- le texte à afficher.
Pour connaitre le nom de la route, aller dans la section "Pages statiques" du site visé,
éditer la page (+), dans formulaire copier le champs "route associée" (ressemble à zpb\_sites\_...)

Un des deux attributs est toujours obligatoires, jamais les deux en même temps. 

####img <a name="img"></a>


__[img url="-adresse-" ]__

Ou -adresse- est l'url relative de l'image (ex "/chemin/vers-mon/image.jpg"), ce paramètre est obligatoire

Paramètres optionnels:

- width="-w-", ou -w- est la largeur en px (ex width="300") ou en pourcentage (ex width="50%")
- height="-h-", idem width
- title="-texte\_de\_l\_intitulé-"
- alt="-texte\_de\_alt-"

exemple complet : [img url="chemin/vers-mon/image.jpg" width="300" height="50%" title="un intitulé" alt="alternatif"]

####youtube <a name="youtube"></a>

__[youtube id="-video\_id-"]__

Ou -video\_id- est l'identifiant de la vidéo. Ce paramètre est obligatoire.

Paramètres optionnels:

- width="-w-", ou -w- est la largeur en px (ex width="300") de la vidéo.
- height="-h-", idem width

exemple complet : [youtube id="3S4m3AQVCiY" width="560" height="315"] 
donnera

&lt;iframe src="//www.youtube.com/embed/3S4m3AQVCiY?rel=0"  width="560" height="315" frameborder="0" allowfullscreen></iframe>
