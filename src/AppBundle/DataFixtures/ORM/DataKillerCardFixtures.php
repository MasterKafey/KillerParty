<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\KillerCard;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class DataKillerCardFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $short = $this->getReference('card-type-short');
        $medium = $this->getReference('card-type-medium');
        $long = $this->getReference('card-type-long');

        $this->saveCard(
            "Star épidémie",
            "Partout",
            "Votre amour de la musique",
            "Vous devez faire chanter votre victime (vous-devez chanter avec elle) La honte la tuera, à moins que cela ne soit le ridicule",
            $short,
            $manager
        );

        $this->saveCard(
            "La dernière bouchée",
            "Les repas et autres collations",
            "Votre nourriture",
            "Votre victime doit ingérer un morceau de ce qui est dans votre assiette. Une fois le morceau dans sa bouche, vous devez lui dire \"C'est bon ?\" La, elle décède, empoisonnée tout simplement",
            $short,
            $manager
        );

        $this->saveCard(
            "Antophobia",
            "Jardin, terrasse",
            "Une fleur non coupée",
            "Faites sentir une fleur, en terre (pot ou pleine terre) à votre victime. Oh, comme c'est dommage, vous ne saviez pas qu'elle était allergique !",
            $short,
            $manager
        );

        $this->saveCard(
            "Létale matière fécale",
            "Partout",
            "Votre force de suggestion",
            "Faites croire à votre victime qu'elle a marché dans une crotte de chien. Elle doit soulever son pied et regarder sous la semelle. Ce faisant, elle perd l'équilibe et tombe sans avoir le temps de dire \"Merde alors !\"",
            $short,
            $manager
        );

        $this->saveCard(
            "Bons baisers de pussy",
            "Partout",
            "Votre baiser",
            "Déposer un baiser sonore sur une partie découverte du corps de votre victime. Après le baiser, vous rajoutez \"Maintenant, tu es à moi !\". Votre victime, totalement privée de sa force mentale va dépérir à petit feu, incapable de se détacher de vous. Un jour, son petit coeur lâchera, las de cette dépendance fatale",
            $short,
            $manager
        );

        $this->saveCard(
            "Un dernier pour la route",
            "L'apéro, les repas et autres collations",
            "Un beau sourire",
            "Trinquez avec votre victime. Entrechoquez votre verre avec le sien en la regardant dans les yeux et en lui disant \"A notre belle amitié\". Après qu'elle a prononcé les mots \"A la tienne\" (ou \"Tchin\" ou quelque phrase équivalente), vous pouvez lui annoncer qu'elle peut enfin mourir en paix, rassurée sur votre compte et avec du plutonium dans le gosier.",
            $short,
            $manager
        );

        $this->saveCard(
            "La mort au bout des mots",
            "Partout",
            "Une phrase",
            "Votre victime doit lire la phrase suivante \"Si tu lis ces mots, tu es mort !\". Ces mots associés les uns aux autres connectent des synapses, qui n'étaient pas connectées : rupture d'anévrisme majeure dans le cerveau de votre victime.",
            $short,
            $manager
        );

        $this->saveCard(
            "Médecine perpendiculaire",
            "Partout",
            "Vos mains",
            "Vous devez faire asseoir votre victime puis lui toucher toucher les deux genous. Le fluide énergetique contenu dans vos mains va bouleverser la chimie interne de votre victime, qui va se retrouver avec le foie au niveau du coeur. Implosion, empoisonnement, dysfonctionnement, fuite d'énergie vitale... mort interne immédiate",
            $short,
            $manager
        );

        $this->saveCard(
            "Fatal divan",
            "Partout",
            "Les souvenirs enfois de votre victime",
            "Vous devez faire prononcer à votre victime le prénom de sa mère ainsi que la profssion de cette dernière puis rajouter \"Quel est le premier souvenir qui te vient là ?\". Laissez courir votre victime jusq'au prochain pont pour qu'elle se jette par dessus le plus vite possible",
            $short,
            $manager
        );

        $this->saveCard(
            "Un verre... six roses",
            "la table du repas",
            "Une boisson, un verre",
            "Servez un verre d'une boisson (pas de l'eau plate !) à votre victime en lui disant : \"Où en est la cirrhose, au fait ?\" Attendez qu'elle ait bu une gorgée. Puis dites-lui \"T'inquiéte pas, c'est pas ça qui te tuera\". Votre victime décède, l'estomac, la cirrhose, la chaise et le plancher bien décapés",
            $short,
            $manager
        );

        $this->saveCard(
            "Pris dans les bouchons",
            "La table du repas",
            "Une bouteille",
            "Faites sentir une bouteille de vin ouverte à votre victime en lui faisant remarquer : \"le vin est bouchonné, tu ne trouve pas ?\". Attendez sa réaction avant de lui répondre \"Le vin je sais pas, mais toi, t'es bien faisandé !\" Elle meurt, les narines rafraîchies à l'acide sulfurique",
            $short,
            $manager
        );

        $this->saveCard(
            "La photo grave",
            "Partout",
            "Tout ce qui prend en photo",
            "Prenez en photo votre victime, Puis, montrez-lui la photo en lui disant \"Tu es à moi, maintenant !\". Voyant sur la photo qu'elle n'a plus d'âme (ses ancêtres vivaient sur les rives du Yupangi en Amérique du sud), elle meurt.",
            $short,
            $manager
        );

        $this->saveCard(
            "Le mousseux n'était pas frais",
            "La cuisine",
            "Une bouteille et le réfrigérateur",
            "Demandez à votre victime d'aller déposer une bouteille pétillante (soda, champagne...) dans le réfrigérateur, en lui recommandant de ne pas trop la remuer. Attendez que le frigo soit fermé. Votre victime ne pourra pas dire qu'elle n'était pas prévenue : les quelques gouttes de nitroglycérine n'auront aucun mal à faire sauter le bouchon (et le frigo et la cuisine et votre victime...)",
            $short,
            $manager
        );

        $this->saveCard(
            "Gorge profonde",
            "Partout",
            "Votre haleine",
            "Ouvrez grand votre bouche. Demandez à votre victime de regarder tout au fond (elle doit être suffisamment proche de vous). Dites \"33 !\" avec la bouche ouverte. La bête qui vit au fond de vous, (en tout cas son odeur) terrasse votre victime qui gardera l'image de votre glotte à jamais gravée au fond de ses rétines",
            $short,
            $manager
        );

        $this->saveCard(
            "Arête. Tu me fais mal !",
            "Partout",
            "Le dénigrement",
            "Amenez votre victime à vous donner une recette contenant au moins du poisson ou des fruits de mer. Lorsqu'elle a fini, lui dire : \"J'ai déjà essayé. C'est dégueulasse ton truc!\". Plus discret et plus sûr qu'une arête de poisson, c'est le dépit qui fera s'étrangler votre victime",
            $short,
            $manager
        );

        $this->saveCard(
            "Le septième sceau",
            "Partout",
            "Votre persuasion",
            "Faites dire à votre victime : \"Je ne triche jamais\" (la même phrase au passé, ou au futur est acceptée). Vous rétorquerez ensuite \"Même avec la mort ?\". Là, elle meurt",
            $short,
            $manager
        );

        $this->saveCard(
            "De l'autre côté",
            "Partout",
            "Vos engagements politiques",
            "Vous devez émettre des opinions politiques, sociales, économiques, sportives ou culturelles totalement provocantes ou décalées. Cela doit être suffisamment net pour que votre victime s'en étonne, s'en offusque ou ironise à votre propos par oral. Plus tard, elle choisira le suicide lorsqu'elle réalisera que désormais tout change, même vous",
            $short,
            $manager
        );

        $this->saveCard(
            "Mon amour, pour toujours",
            "Partout",
            "Les commérages",
            "Vous devez vous allonger à côté de votre victime sur le sol et lui déposer un petit baiser (où vous le souhaitez). Arrangez-vous pour que ce geste soit aperçu par un tiers. Les rumeurs vont finir par atteindre le compagnon de votre victime. Qui la quittera. Votre victime délaissée, dépérira, en se vengeant sur la nourriture. Un peu trop",
            $long,
            $manager
        );

        $this->saveCard(
            "Létales pétales",
            "Où vous voulez",
            "Des pétales de fleurs",
            "Votre victime doit marcher, pieds nus, sur une dizaine de pétales de fleurs que vous aurez préalablement jetés sur le sol. Les quelques milligrammes de poison excitant contenu dans ces fleurs vont réveiller brutalement les champignons de votre victime. Excités, affamés, ils vont tout simplement dévorer votre victime de l'intérieur. Ignoble, non ?",
            $long,
            $manager
        );

        $this->saveCard(
            "De bien louches lunettes",
            "Les toilettes, la salle de bain",
            "Les lunettes des wc",
            "Glissez un petit mot sous le couvercle des WC avec l'inscription suivante \"Plus près, crétin(e) :\". Votre victime devra le lire, après avoir soulevé le couvercle en question bien évicemment. Sa mort ? Une mort idiote ! La victime, en s'approchant, glisse sur le sol malpropre, la tête la première dans la cuvette. Aspirée dans les tuyaux ou simplement noyée... tout dépend de son envergure.",
            $long,
            $manager
        );

        $this->saveCard(
            "Meutre à la lune !",
            "Partout",
            "Votre déduction",
            "Vous enquêtez sur ces meurtres en série, jusqu'à être en mesure d'intercepter un tueur qui va passer à l'action... Découvrez la cible de votre victime pour remplir votre mission. Puis expliquez à votre victime que vous l'avez démasquée. Piégée par la presse ? Elle se suicide plutôt",
            $long,
            $manager
        );

        $this->saveCard(
            "La dernière céne",
            "Le jardin, la terrasse, le balcon",
            "Votre bon goût",
            "Composez un joli tableau comportant au moins une chaise, un livre, un téléphone, un verre, quelques fleurs et un chapeau. La victime doit s'asseoir sur la chaise. Apaisée, reposée par votre décor, elle s'endormira pour toujours, les yeux dans les fleurs",
            $long,
            $manager
        );

        $this->saveCard(
            "Le baiser du caméléon",
            "Partout",
            "Votre sens esthétique",
            "Sur deux de vos vêtements au moins, vous devez décliner cinq couleurs portées par votre victime (si elle n'est vêtue que d'une seule, tant mieux pour vous, ce sera plus facile !). Ainsi paré(e), tirez la langue à votre victime pour qu'elle vous remarque : gobée, elle s'évanouira dans le paysage",
            $long,
            $manager
        );

        $this->saveCard(
            "Un pied sous terre",
            "Partout",
            "Des chaussures (non chaussées)",
            "Votre victime doit pénétrer dans un cercle formé de neuf chaussures ensorcelées par un prête haïtien cercle de trois mètres de diamètre maximum. Là, vous devez dire à votre victime : \"T'as vu dans quoi t'as mis les pieds ?\". Elle meurt, ça lui fera les pieds",
            $long,
            $manager
        );

        $this->saveCard(
            "Naturopsychopathie",
            "Partout",
            "La médecine naturelle et des plantes séchées",
            "Cachez 5 sachets de thé ou de tisane sur votre victime (dans ses vêtements, son sac...). Attention : pour agir, ces sachets bienfaisants doivent être obligatoirement séparés les uns des autres. Attendez le moment où votre victime les porte tous sur elle avant de lui demander : \"Ca va ces jours-ci ?\". Ensuite, montrez-lui les différents éléments dissimulés sur elle : damned, tout est contaminé aux pesticides ! Trop portée sur l'écologie, se considérant comme un produit nuisible, la victime met donc fin à ses jours",
            $long,
            $manager
        );

        $this->saveCard(
            "Les dents de la mort",
            "La salle de bain",
            "Un produit qui fait pousser les cheveux",
            "Recouvrez la brosse à dents de votre victime d'huile alimentaire, de vinaigre ou de fromage. Votre victime doit s'emparer de sa brosse. A la moindre grimace, protestation, remarque, crachat, sourire ou cri, vous criez \"Poil au dents !\". Votre victime meurt, étouffée par une soudaine jungle de mousse buccale, née spontanément sur ses dents",
            $long,
            $manager
        );

        $this->saveCard(
            "Le pentacle de l'au-delà",
            "Partout, mais dans un lieu isolé des autres",
            "5 personnes uniquement (dont vous)",
            "Dans une pièce, vous devez réunir dans un rayon d'environ quatre mètres, votre victime, vous-même, une personne de sexe masculin, une autre de sexe féminin et un enfant... Votre victime s'électrocute dans le champ électrique dégagé par ce puzzle humain, la malédiction a encore frappé...",
            $long,
            $manager
        );

        $this->saveCard(
            "Déboulonné",
            "Une voiture",
            "Votre sens de la persuasion",
            "Vous devez ouvrir la portière de votre victime lorsqu'elle monte ou descend de la voiture. Comme vous avez pris soin de dévisser la portière, elle se la prendra sur le pied, celle-ci lui sectionnant net l'artère carotide qui entre l'humérus et le métacarpien. Handicapée mortellement, glissant dans son propre sang, elle finira par périr sans avoir retrouvé son pied",
            $long,
            $manager
        );

        $this->saveCard(
            "Plus belle la mort",
            "Là où vit la télévision",
            "Votre main",
            "Pendant que votre victime regarde la télévision en direct (ni DVD, ni magnétoscope), éteignez-la en débranchant sa prise éléctrique. Un sevrage trop brutal pour le cerveau de votre victime qui s'effondre, s'empalant de surcroît sur la télécommande",
            $long,
            $manager
        );

        $this->saveCard(
            "Fatale sortie de bain",
            "La salle de bain",
            "Des serviettes de bain",
            "Pendant que votre victime se douche, enlevez les serviettes de la salle de bain en lui criant : \"Là, c'est moi qui t'ai séché, ha !, ha !, ha !\". La malheureuse sera bien obligée de sortir mouillée sur le carrelage. La suite est, hélas, bien connu : glissade, lavabo, nuque, cercueil...",
            $long,
            $manager
        );

        $this->saveCard(
            "L'éponge ne passait pas",
            "Le bac à vaisselle de la cuisine",
            "L'éponge",
            "Amenez votre victime à faire la vaisselle avec vous. Attendez qu'elle ait l'éponge en main puis dites : \"Depuis le temps que j'attends ça, flemmard(e) !\". Difficle de savoir qui de l'injure ou de l'acide chlorhydrique, porte le coup fatal",
            $long,
            $manager
        );

        $this->saveCard(
            "Le chant des sirénes d'alexandrie",
            "La piste de danse",
            "Le fantôme de Claude François",
            "Arrangez vous pour que votre victime se mette à danser ou chanter sur le refrain d'\"Alexandrie Alexandra\" de Claude François. Là, convoquez l'esprit de l'artiste en vous mettant à genoux et en criant \"Ô Cloclo, viens et accepte mon offrande !\" (votre victime doit vous entendre). Le Grand Claude apparaîtra et repartira avec votre victime, ensorcelée",
            $medium,
            $manager
        );

        $this->saveCard(
            "Le dernier slow",
            "Piste de danse",
            "Vos phéromones",
            "Dansez un slow avec votre victime. Le lien chimique entre elle et vous s'établira immédiatement. Intoxiquée à vos effluves, votre victime se suicidera dès votre première séparation (la fin du slow, donc)",
            $medium,
            $manager
        );

        $this->saveCard(
            "Le fantôme de l'opéra",
            "Partout, mais seul(e) avec votre victime",
            "Votre voix",
            "Entonner un air d'opéra, en tentant d'imiter une cantatrice. Les tympans perforés, votre victime n'entend pas le train Strasbourg-Mâcon qui lui arrive dessus",
            $medium,
            $manager
        );

        $this->saveCard(
            "Boulevard du crime",
            "Là où vivent les voitures",
            "Une voiture",
            "Votre victime doit s'asseoir sur le capot d'une voiture. Ce qu'elle ignorait, c'est que le frein à main n'était pas mis. Fin de parcours pour la victime",
            $medium,
            $manager
        );

        $this->saveCard(
            "Meurtre au vitriol",
            "Partout",
            "Un verre d'eau",
            "Défigurez votre victime en lui jetant à la face un verre d'eau",
            $medium,
            $manager
        );

        $this->saveCard(
            "60 secondes et la poussière",
            "Partout, mais seul(e) avec votre victime",
            "Montre, portable, réveil, horloge, tout ce qui donne l'heure",
            "En étant absolument seul(e) avec votre victime, vous devez lui montrer l'heure. Il doit être exactement l'heure X:00 (une heure pile : 3h00, 4h00, etc.). Vous n'avez donc qu'une minute chaque heure pour commettre votre crime. Ce faisant, vous direz à votre victime \"Allons-y maintenant, je déteste être en retard... \"",
            $medium,
            $manager
        );

        $this->saveCard(
            "Peurs bleues",
            "Partout",
            "Vous, tout, n'importe quoi",
            "Vous devez obtenir une réaction de peur de votre victime. Un cri serait parfait. Un sursaut est accepté. Un clignement d'oeil... non",
            $medium,
            $manager
        );

        $this->saveCard(
            "Acide est la vie",
            "Table du repas, apéros et collations",
            "Le citron",
            "Votre victime doit au moins tremper les lèvres dans un jus de citron que vous aurez préalablement pressé et dilué à l'eau ou dans la boisson de votre choix. Son sinistre sourire béat l'accompagnera vers l'éternité",
            $medium,
            $manager
        );

        $this->saveCard(
            "Fin de communication",
            "Partout",
            "Un téléphone",
            "Vous devez téléphoner à votre victime, mais elle ne doit pas vous reconnaître (elle peut être dans l'ignorance totale ou vous prendre pour quelqu'un d'autre). Dites-lui alors \"Vous devez mourir... maintenant\"",
            $medium,
            $manager
        );

        $this->saveCard(
            "A cran",
            "Partout",
            "Un couteau",
            "Vous devez tendre un couteau à votre victime, pointe tendue vers elle, en lui disant \"Tiens, prends ça !\". Dès qu'elle a touché le couteau (elle doit le prendre en main, ce n'est pas vous qui la touchez), elle meurt, éventrée",
            $medium,
            $manager
        );

        $this->saveCard(
            "Défait par des dés",
            "Partout",
            "Deux dés (saupoudrés de cyanure)",
            "Votre victime doit sortir au moins deux dès affichant chacun 6, dans un jet de dès effectué par elle-même. Vous devez demander confirmation à votre victime \"Tu as bien plusieurs 6, là ?\" et attendre son acquiescement pour que le cyanure atteigne son cerveau et la foudroie instantanément",
            $medium,
            $manager
        );

        $this->saveCard(
            "Qui gange perd",
            "Les tables de jeu",
            "Votre intelligence",
            "Vous devez vous arranger pour que votre victime remporte une partie (ou finisse mieux classé/placé que vous). A la fin de la partie, flattez votre victime \"Bravo ! Tu joues tellement mieux que moi ! \". En vous écoutant, elle se rengorge de fierté... jusqu'a s'en faire éclater le coeur",
            $medium,
            $manager
        );

        $this->saveCard(
            "Les yeux revolver",
            "Partout",
            "Votre regard, ses lunettes",
            "Vous devez faire chausser des lunettes de soleil à votre victime. Puis, vous devez lui dire \"Tu me vois, là ?\". Après sa réaction, vous rajoutez \"Et bien là tu me vois plus !\". Le regard qui tue ? C'est tout à fait vous !",
            $medium,
            $manager
        );

        $this->saveCard(
            "Qui perd, perd tout",
            "Partout",
            "Le malheur de votre adversaire",
            "Vous devez battre votre victime dans une activité ludique ou sportive. Vou pourrez lui asséner ensuite : \" Je t'ai battu mon vieux/ma vieille, dommage pour toi !\". C'est la voûte qui fait déborder le gaz : accablée par la vie, elle lâche prise sur la vie et se laisse mourir de faim",
            $medium,
            $manager
        );

        $this->saveCard(
            "Les flammes de l'enfer",
            "La cuisine",
            "Une allumette",
            "Votre victime doit enflammer une allumette de la boîte que vous lui tendez. Elle est ravie de vous faire plaisir et s'enflamme littéralement lorsqu'elle découvre que votre allumette fonctionnait au napalm",
            $medium,
            $manager
        );

        $this->saveCard(
            "Les flagorneries infernales",
            "Partout",
            "Votre langue",
            "Devant témoin(s), prononcez en trois endroits différents et à trois moments espacés d'au moins un quart d'heure, trois compliments à votre victime, concernant 1) sa coiffure, 2) sa diction et 3) la forme de ses oreilles. Le dernier compliment doit être dis tandis que la victime se tient devant un miroir. La, lancez-lui \"Ca va les chevilles ?\" pour qu'elle décéde par explosion de chevilles. (Si, si c'est possible !)",
            $medium,
            $manager
        );

        $this->saveCard(
            "Les fleurs du mal",
            "Partout",
            "Des fleurs",
            "Donnez devant témoin(s), un bouguet d'au moins cinq fleurs à votre victime. Celle-ci doit approcher son nez de votre bouquet (attention : il s'agit bien de son nez qui va vers le bouquet et non du bouquet qui va vers son nez). Là, l'abeille cachée dans les pétales s'évade dans les narines de la victime, fait un joli petit trajet dans son corps puis, coincée entre l'oreille interne et le cervelet droit, elle entreprend de perforer votre victime. Mais sans méchanceté",
            $medium,
            $manager
        );

        $this->saveCard(
            "Vieillesse spontanée",
            "Partout",
            "La perfidie",
            "Souhaitez un joyeux anniversaire à votre victime, même si ce n'est pas le sien, en lui offrant un petit cadeau (ce que vous voulez, mais emballé). Votre victime doit le prendre. Malgrè sa joie, elle ne peut s'empêcher de se rappeler qu'elle prend un an chaque année (ce qu'elle occultait jusqu'ici). Votre geste réveille ce qui se cachait. Elle prend 50 ans en deux secondes, se racornit et meurt",
            $medium,
            $manager
        );

        $this->saveCard(
            "Feu de joie, feu de foi",
            "Une cheminée, n barbecue, un foyer",
            "Le feu",
            "Préparez un feu en compagnie de votre victime. Lorsque vous allumerez ce feu ou lorsqu'elle l'allumera (il faut qu'elle soit à côté de vous, l'attention mobilisée par le feu), dites-lui \"Tu vois ce bout de bois, là ? Et bien c'est toi, sale hérétique !\". Si votre victime a de l'humour (ou la foi, tout simplement), elle criera \"Ô Dieu ! Je ne te renierai jamais !\", histoire de créer l'ambiance",
            $medium,
            $manager
        );

        $this->saveCard(
            "Exquis maux",
            "La cuisine",
            "Le congélateur, le réfrigérateur",
            "Emparez-vous d'un objet appartenant à votre victime (Ce peut être un objet qui lui appartient momentanément, comme une fourchette, un verre ou une serviette !) Placez-le dans le congélateur/réfrigérateur. Votre victime, (elle seule !) devra aller le récupérer dans le congélateur/réfrigérater. A l'instant même où elle s'en saisit, la porte se referme sur elle. Malgré ses cris et tous ses efforts, votre victime ne sera retrouvée que le lendemain, façon cône givré",
            $medium,
            $manager
        );

        $this->saveCard(
            "On achève bien les chevaux",
            "Piste de dance",
            "La danse",
            "Vous devez danser deux fois avec votre victime en lui tenant les mains à chaque fois, et sur des musiques rythmées (pas de slows). A la fin de la deuxième danse, vous lui ferez remarquer cette étrange rougeur au visage. Et cet essoufflement. Et.. elle n'entendra pas votre dernière remarque (\" T'as pas l'air bien du tout !\"), foudroyée par une crise cardiaque majeure",
            $medium,
            $manager
        );

        $this->saveCard(
            "Rira bien qui rira le dernier",
            "Seul ou presque (pas plus de trois personnes présentes dans un cercle de trois mètres)",
            "Votre humour",
            "Obtenir un rire de votre victime. Un sourire ne peut suffire, il faut un bruit franc, preuve que votre victime sétouffe réellement, et qu'elle meurt de rire",
            $medium,
            $manager
        );
        $manager->flush();
    }

    protected function saveCard($title, $place, $weapon, $objective, $type, ObjectManager $manager)
    {
        $killerCard = (new KillerCard())->setPlace($place)->setWeapon($weapon)->setObjective($objective)->setTitle($title)->setType($type);
        $manager->persist(
            $killerCard
        );

        return $killerCard;
    }

    public function getOrder()
    {
        return 200;
    }
}
