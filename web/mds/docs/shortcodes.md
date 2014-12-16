###Qu'est-ce qu'un shortcode

lorem ipsum

###Shortcodes utilisables

- [link](#link)
- [img](#img)
- [youtube](#youtube)
- [pdf](#pdf)

###link <a name="link"></a>

__[link url="-adresse-"]-texte-[/link]__

Où -adresse- est l'url absolue ou relative et -texte- le texte à afficher dans la page ( pas de html )

__[link route="-nom_de_la_route-"]-texte-[/link]__

Où -nom\_de\_la\_route- est le nom de la route qui sera transformé en url absolue en interne et -texte- le texte à afficher.
Pour connaitre le nom de la route, aller dans la section "Pages statiques" du site visé,
éditer la page (+), dans formulaire copier le champs "route associée" (ressemble à zpb\_sites\_...)

__Un des deux attributs est toujours obligatoires, jamais les deux en même temps.__

###img <a name="img"></a>


__[img url="-adresse-" ]__

Où -adresse- est l'url relative de l'image (ex "/chemin/vers-mon/image.jpg")

__[img filename="-nom_du_fichier-" ]__

Où -nom\_du\_fichier- est le nom du fichier image

__filename ou url sont obligatoires, jamais les deux en même temps.__



Paramètres optionnels :

- width="-w-", ou -w- est la largeur en px (ex width="300") ou en pourcentage (ex width="50%")
- height="-h-", idem width
- title="-texte\_de\_l\_intitulé-"
- alt="-texte\_de\_alt-"
- class="-classes\_css"

exemples complets :

- avec url : [img url="/chemin/vers-mon/image.jpg" width="300" height="50%" title="un intitulé" alt="alternatif" class="align-right bordered"]
- avec filename : [img filename="monimage.jpg" width="300" height="50%" title="un intitulé" alt="alternatif" class="align-right bordered"]

###youtube <a name="youtube"></a>

__[youtube id="-video\_id-"]__

Où -video\_id- est l'identifiant de la vidéo. Ce paramètre est obligatoire.

Paramètres optionnels :

- width="-w-", ou -w- est la largeur en px (ex width="300") de la vidéo.
- height="-h-", idem width

exemple complet : [youtube id="3S4m3AQVCiY" width="560" height="315"] 

donnera :

`<iframe src="//www.youtube.com/embed/3S4m3AQVCiY?rel=0"  width="560" height="315" frameborder="0" allowfullscreen></iframe>`

###pdf <a name="pdf"></a>

__[pdf filename="-nom\_du\_fichier-"]-texte-[/pdf]__

Où -nom\_du\_fichier- est le nom du fichier pdf, ce paramètre est obligatoire.

Paramètres optionnels :

- title="-texte\_de\_l\_intitulé-"
- alt="-texte\_de\_alt-"
- class="-classes\_css-"

exemple complet : [pdf filename="nomdufichier.pdf" title="un intitulé" alt="alternatif" class="class1 class2"]télécharger le pdf[/pdf]

donnera :

`<a href="/telechargements/pdf/nomdufichier.pdf" title="un intitulé" alt="alternatif" class="class1 class2">télécharger le pdf</a>`






