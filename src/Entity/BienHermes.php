<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;

/**
 * BienHermes
 *
 * @ORM\Table(name="bien_hermes", indexes={@ORM\Index(name="LoyerAnnuel", columns={"LoyerAnnuel"}), @ORM\Index(name="Categorie", columns={"Categorie"}), @ORM\Index(name="VisitCounter", columns={"VisitCounter"}), @ORM\Index(name="TypeTransact", columns={"TypeTransact"}), @ORM\Index(name="TypeBien", columns={"TypeBien"}), @ORM\Index(name="CodePostal", columns={"CodePostal"}), @ORM\Index(name="PrixPublic", columns={"PrixPublic"}), @ORM\Index(name="SurfaceTotale", columns={"SurfaceTotale"}), @ORM\Index(name="NbPiecesLogement", columns={"NbPiecesLogement"}), @ORM\Index(name="Top", columns={"Top"}), @ORM\Index(name="Statut", columns={"Statut"}), @ORM\Index(name="bNaxos", columns={"bNaxos"}), @ORM\Index(name="Activite", columns={"Activite"})})
 * @ORM\Entity(repositoryClass="App\Repository\BienHermesRepository")
 */
class BienHermes
{
    /**
     * type de transaction
     */
    const TYPETRANSACTION = [
        1 => 'Vente fonds de commerce',
        2 => 'Gérance',
        3 => 'Vente location immobilier d\'entreprise',
        4 => 'Location',
        5 => 'DAB'
    ];

    const TYPEBIEN = [
      1 => 'Murs ou local commercial',
      2 => 'Immobilier d\'entreprise',
      10 => 'Café-Bar-Brasserie-Restaurant-Tabac',
      20 => 'Hôtel-Auberge-Camping',
      30 => 'Boulangerie-Pâtisserie-Confiserie-Terminal de cuisson',
      40 => 'Beauté & soins du corps',
      41 => 'Equipement de la maison',
      42 => 'Equipement de la personne',
      43 => 'Métiers de bouche',
      50 => 'Divers'
    ];

    /**
     * @var int
     *
     * @ORM\Column(name="CodeReseau", type="smallint", nullable=false, options={"default"="000","unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $codereseau = '000';

    /**
     * @var int
     *
     * @ORM\Column(name="CodeAgence", type="smallint", nullable=false, options={"default"="0000","unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $codeagence = '0000';

    /**
     * @var int
     *
     * @ORM\Column(name="Numero", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $numero = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateEntree", type="date", nullable=false, options={"default"="0000-00-00"})
     */
    private $dateentree = '0000-00-00';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DateUpdate", type="date", nullable=true)
     */
    private $dateupdate;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="Statut", type="boolean", nullable=true)
     */
    private $statut = '0';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DateRetrait", type="date", nullable=true)
     */
    private $dateretrait;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TitreAnnonce", type="text", length=16777215, nullable=true)
     */
    private $titreannonce;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Annonce", type="text", length=16777215, nullable=true)
     */
    private $annonce;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="Top", type="boolean", nullable=true)
     */
    private $top = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="TypeTransact", type="smallint", nullable=true)
     */
    private $typetransact = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="TypeBien", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $typebien;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NumeroMurs", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $numeromurs;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Negociateur", type="string", length=40, nullable=true)
     */
    private $negociateur;

    /**
     * @var string
     *
     * @ORM\Column(name="Denomination", type="string", length=40, nullable=false)
     */
    private $denomination = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="NumVoie", type="string", length=10, nullable=true)
     */
    private $numvoie;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TypeVoie", type="string", length=20, nullable=true)
     */
    private $typevoie;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NomVoie", type="string", length=40, nullable=true)
     */
    private $nomvoie;

    /**
     * @var string|null
     *
     * @ORM\Column(name="SuiteAdresse", type="string", length=40, nullable=true)
     */
    private $suiteadresse;

    /**
     * @var string|null
     *
     * @ORM\Column(name="CodePostal", type="string", length=5, nullable=true)
     */
    private $codepostal;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Ville", type="string", length=30, nullable=true)
     */
    private $ville;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Telephone", type="string", length=14, nullable=true)
     */
    private $telephone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Fax", type="string", length=14, nullable=true)
     */
    private $fax;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Email", type="string", length=50, nullable=true)
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="uidVendeur", type="string", length=15, nullable=true)
     */
    private $uidvendeur;

    /**
     * @var string|null
     *
     * @ORM\Column(name="uidAdministrateur", type="string", length=15, nullable=true)
     */
    private $uidadministrateur;

    /**
     * @var string|null
     *
     * @ORM\Column(name="uidMandataire", type="string", length=15, nullable=true)
     */
    private $uidmandataire;

    /**
     * @var string
     *
     * @ORM\Column(name="Activite", type="string", length=100, nullable=false)
     */
    private $activite = '';

    /**
     * @var int|null
     *
     * @ORM\Column(name="PrixPublic", type="integer", nullable=true)
     */
    private $prixpublic;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="Licence", type="boolean", nullable=true)
     */
    private $licence;

    /**
     * @var string
     *
     * @ORM\Column(name="Categorie", type="string", length=2, nullable=false, options={"fixed"=true})
     */
    private $categorie = '';

    /**
     * @var int|null
     *
     * @ORM\Column(name="DroitAuBail", type="integer", nullable=true)
     */
    private $droitaubail;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TypeBail", type="string", length=40, nullable=true)
     */
    private $typebail;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DateFinBail", type="date", nullable=true)
     */
    private $datefinbail;

    /**
     * @var int|null
     *
     * @ORM\Column(name="LoyerAnnuel", type="integer", nullable=true)
     */
    private $loyerannuel;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NbPiecesLogement", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $nbpieceslogement;

    /**
     * @var string|null
     *
     * @ORM\Column(name="DescriptifLogement", type="string", length=40, nullable=true)
     */
    private $descriptiflogement;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Quartier", type="string", length=100, nullable=true)
     */
    private $quartier;

    /**
     * @var string|null
     *
     * @ORM\Column(name="FermetureHebdo", type="string", length=40, nullable=true)
     */
    private $fermeturehebdo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Horaires", type="string", length=40, nullable=true)
     */
    private $horaires;

    /**
     * @var string|null
     *
     * @ORM\Column(name="CongesAnnuel", type="string", length=40, nullable=true)
     */
    private $congesannuel;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NbEmployes", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $nbemployes;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NbSaisonniers", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $nbsaisonniers;

    /**
     * @var int|null
     *
     * @ORM\Column(name="SurfaceTotale", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $surfacetotale;

    /**
     * @var string|null
     *
     * @ORM\Column(name="DetailSurfaces", type="text", length=16777215, nullable=true)
     */
    private $detailsurfaces;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="BienAngle", type="boolean", nullable=true)
     */
    private $bienangle;

    /**
     * @var int|null
     *
     * @ORM\Column(name="LineaireFacade", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $lineairefacade;

    /**
     * @var string|null
     *
     * @ORM\Column(name="EtatLieux", type="string", length=40, nullable=true)
     */
    private $etatlieux;

    /**
     * @var string|null
     *
     * @ORM\Column(name="EtatMateriel", type="string", length=40, nullable=true)
     */
    private $etatmateriel;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CAHT", type="integer", nullable=true)
     */
    private $caht;

    /**
     * @var int|null
     *
     * @ORM\Column(name="AchatHT", type="integer", nullable=true)
     */
    private $achatht;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ChargesExternes", type="integer", nullable=true)
     */
    private $chargesexternes;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Salaires", type="integer", nullable=true)
     */
    private $salaires;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ChargesSociales", type="integer", nullable=true)
     */
    private $chargessociales;

    /**
     * @var int|null
     *
     * @ORM\Column(name="RBE", type="integer", nullable=true)
     */
    private $rbe;

    /**
     * @var string|null
     *
     * @ORM\Column(name="uidComptable", type="string", length=15, nullable=true)
     */
    private $uidcomptable;

    /**
     * @var int|null
     *
     * @ORM\Column(name="DroitEntree", type="integer", nullable=true)
     */
    private $droitentree;

    /**
     * @var int|null
     *
     * @ORM\Column(name="LoyerPossible", type="integer", nullable=true)
     */
    private $loyerpossible;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="Divisible", type="boolean", nullable=true)
     */
    private $divisible;

    /**
     * @var int|null
     *
     * @ORM\Column(name="MinimumDivisible", type="integer", nullable=true)
     */
    private $minimumdivisible;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="Despecialisation", type="boolean", nullable=true)
     */
    private $despecialisation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Disponibilite", type="string", length=10, nullable=true)
     */
    private $disponibilite;

    /**
     * @var int|null
     *
     * @ORM\Column(name="PrixM2", type="integer", nullable=true)
     */
    private $prixm2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Dessertes", type="string", length=50, nullable=true)
     */
    private $dessertes;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NotesDessertes", type="text", length=16777215, nullable=true)
     */
    private $notesdessertes;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Construction", type="string", length=10, nullable=true)
     */
    private $construction;

    /**
     * @var int|null
     *
     * @ORM\Column(name="AnneeConstruction", type="smallint", nullable=true)
     */
    private $anneeconstruction;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Architecture", type="string", length=40, nullable=true)
     */
    private $architecture;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NotesArchitecture", type="text", length=16777215, nullable=true)
     */
    private $notesarchitecture;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Energie", type="string", length=40, nullable=true)
     */
    private $energie;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NotesEnergie", type="text", length=16777215, nullable=true)
     */
    private $notesenergie;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Amenagement", type="string", length=10, nullable=true)
     */
    private $amenagement;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Cablage", type="string", length=30, nullable=true)
     */
    private $cablage;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NotesBureau", type="text", length=16777215, nullable=true)
     */
    private $notesbureau;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NotesIE", type="text", length=16777215, nullable=true)
     */
    private $notesie;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Specialite", type="string", length=40, nullable=true)
     */
    private $specialite;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NbPlaces", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $nbplaces;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Terrasse", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $terrasse;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NbCouvertsMidi", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $nbcouvertsmidi;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NbCouvertsSoir", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $nbcouvertssoir;

    /**
     * @var int|null
     *
     * @ORM\Column(name="RecetteJour", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $recettejour;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Hecto", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $hecto;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NbKgsCafe", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $nbkgscafe;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NotesCHR", type="text", length=16777215, nullable=true)
     */
    private $noteschr;

    /**
     * @var int|null
     *
     * @ORM\Column(name="RemTabac", type="integer", nullable=true)
     */
    private $remtabac;

    /**
     * @var int|null
     *
     * @ORM\Column(name="RemLoto", type="integer", nullable=true)
     */
    private $remloto;

    /**
     * @var int|null
     *
     * @ORM\Column(name="RemPMU", type="integer", nullable=true)
     */
    private $rempmu;

    /**
     * @var int|null
     *
     * @ORM\Column(name="RemLoterie", type="integer", nullable=true)
     */
    private $remloterie;

    /**
     * @var int|null
     *
     * @ORM\Column(name="RemPresse", type="integer", nullable=true)
     */
    private $rempresse;

    /**
     * @var int|null
     *
     * @ORM\Column(name="RemJeux", type="integer", nullable=true)
     */
    private $remjeux;

    /**
     * @var int|null
     *
     * @ORM\Column(name="RemAutres", type="integer", nullable=true)
     */
    private $remautres;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CATabletterie", type="integer", nullable=true)
     */
    private $catabletterie;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CACartes", type="integer", nullable=true)
     */
    private $cacartes;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CATimbres", type="integer", nullable=true)
     */
    private $catimbres;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CAAutres", type="integer", nullable=true)
     */
    private $caautres;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="MachCafeDepot", type="boolean", nullable=true)
     */
    private $machcafedepot = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="CategorieHotel", type="string", length=10, nullable=true)
     */
    private $categoriehotel;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NbChambresSimples", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $nbchambressimples;

    /**
     * @var string|null
     *
     * @ORM\Column(name="BecPression", type="string", length=3, nullable=true, options={"default"="Non","fixed"=true})
     */
    private $becpression = 'Non';

    /**
     * @var int|null
     *
     * @ORM\Column(name="NbChambresDoubles", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $nbchambresdoubles;

    /**
     * @var int|null
     *
     * @ORM\Column(name="TauxRemplissage", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $tauxremplissage;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NbPlacesSA", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $nbplacessa;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NbPlacesSPdJ", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $nbplacesspdj;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NbPlacesPk", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $nbplacespk;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NbSallesReunion", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $nbsallesreunion;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CapaciteSalleReunion", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $capacitesallereunion;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Discotheque", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $discotheque;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Casino", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $casino;

    /**
     * @var int|null
     *
     * @ORM\Column(name="SalleMassage", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $sallemassage;

    /**
     * @var int|null
     *
     * @ORM\Column(name="SalleGymnastique", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $sallegymnastique;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Piscine", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $piscine;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NbTennis", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $nbtennis;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Golf", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $golf;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NotesHotel", type="text", length=16777215, nullable=true)
     */
    private $noteshotel;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CABoulangerie", type="integer", nullable=true)
     */
    private $caboulangerie;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CAPatisserie", type="integer", nullable=true)
     */
    private $capatisserie;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CATraiteur", type="integer", nullable=true)
     */
    private $catraiteur;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CASandwicherie", type="integer", nullable=true)
     */
    private $casandwicherie;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CAConfiserie", type="integer", nullable=true)
     */
    private $caconfiserie;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CAGlacier", type="integer", nullable=true)
     */
    private $caglacier;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CAChocolatier", type="integer", nullable=true)
     */
    private $cachocolatier;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NotesBPCT", type="text", length=16777215, nullable=true)
     */
    private $notesbpct;

    /**
     * @var int|null
     *
     * @ORM\Column(name="MontantStock", type="integer", nullable=true)
     */
    private $montantstock;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NotesAC", type="text", length=16777215, nullable=true)
     */
    private $notesac;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NotesNego", type="text", length=16777215, nullable=true)
     */
    private $notesnego;

    /**
     * @var int|null
     *
     * @ORM\Column(name="VisitCounter", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $visitcounter = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="NbBungalows", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $nbbungalows;

    /**
     * @var bool
     *
     * @ORM\Column(name="bNaxos", type="boolean", nullable=false)
     */
    private $bnaxos = '0';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="TenuDepuis", type="date", nullable=true)
     */
    private $tenudepuis;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NbEtage", type="integer", nullable=true)
     */
    private $nbetage;

    /**
     * @var int|null
     *
     * @ORM\Column(name="SurfaceSol", type="integer", nullable=true)
     */
    private $surfacesol;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NbChambres", type="integer", nullable=true)
     */
    private $nbchambres;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NbPlacesAssises", type="integer", nullable=true)
     */
    private $nbplacesassises;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NbPlacesTerrasse", type="integer", nullable=true)
     */
    private $nbplacesterrasse;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NbPlacesBar", type="integer", nullable=true)
     */
    private $nbplacesbar;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TypeEmplacement", type="string", length=50, nullable=true)
     */
    private $typeemplacement;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="Climatisation", type="boolean", nullable=true)
     */
    private $climatisation;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ChargeSol", type="integer", nullable=true)
     */
    private $chargesol;

    /**
     * @var string|null
     *
     * @ORM\Column(name="HauteurSousPoutres", type="string", length=10, nullable=true)
     */
    private $hauteursouspoutres;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NbPorteQuai", type="integer", nullable=true)
     */
    private $nbportequai;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DateLiberation", type="date", nullable=true)
     */
    private $dateliberation;

    /**
     * @var int|null
     *
     * @ORM\Column(name="TaxeFonciere", type="integer", nullable=true)
     */
    private $taxefonciere;

    /**
     * @var int|null
     *
     * @ORM\Column(name="TaxeBureau", type="integer", nullable=true)
     */
    private $taxebureau;

    /**
     * @var int|null
     *
     * @ORM\Column(name="QuintauxFarine", type="integer", nullable=true)
     */
    private $quintauxfarine;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ChargesLocativesMois", type="string", length=50, nullable=true)
     */
    private $chargeslocativesmois;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CommTotales", type="integer", nullable=true)
     */
    private $commtotales;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CAHTRestaurant", type="integer", nullable=true)
     */
    private $cahtrestaurant;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CAHTBar", type="integer", nullable=true)
     */
    private $cahtbar;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CAHTHotellerie", type="integer", nullable=true)
     */
    private $cahthotellerie;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CAHTRestauration", type="integer", nullable=true)
     */
    private $cahtrestauration;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CAHTDivers", type="integer", nullable=true)
     */
    private $cahtdivers;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CAHTAEmporter", type="integer", nullable=true)
     */
    private $cahtaemporter;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CAHTCoiffure", type="integer", nullable=true)
     */
    private $cahtcoiffure;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CAHTEsthetique", type="integer", nullable=true)
     */
    private $cahtesthetique;

    /**
     * @var int|null
     *
     * @ORM\Column(name="PERF", type="integer", nullable=true)
     */
    private $perf;

    /**
     * @var string|null
     *
     * @ORM\Column(name="LettreDPE", type="string", length=10, nullable=true)
     */
    private $lettredpe;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ValeurDPE", type="integer", nullable=true)
     */
    private $valeurdpe;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DateDPE", type="date", nullable=true)
     */
    private $datedpe;

    /**
     * @var string|null
     *
     * @ORM\Column(name="LettreGES", type="string", length=10, nullable=true)
     */
    private $lettreges;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ValeurGES", type="integer", nullable=true)
     */
    private $valeurges;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DateGES", type="date", nullable=true)
     */
    private $dateges;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="NonSoumisDPE", type="boolean", nullable=true)
     */
    private $nonsoumisdpe = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="DPEenCours", type="boolean", nullable=true)
     */
    private $dpeencours = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="NouvelleEnseigne", type="string", length=20, nullable=true)
     */
    private $nouvelleenseigne;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PhotoTransaction", type="string", length=80, nullable=true)
     */
    private $phototransaction;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NoteNouvelleEnseigne", type="text", length=16777215, nullable=true)
     */
    private $notenouvelleenseigne;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TypeMandat", type="string", length=20, nullable=true)
     */
    private $typemandat;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NumeroMandat", type="string", length=20, nullable=true)
     */
    private $numeromandat;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DateDebutMandat", type="date", nullable=true)
     */
    private $datedebutmandat;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DateFinMandat", type="date", nullable=true)
     */
    private $datefinmandat;

    /**
     * @var string|null
     *
     * @ORM\Column(name="SiretRCS", type="string", length=20, nullable=true)
     */
    private $siretrcs;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="Alur_CommissionChargeAcquereur", type="boolean", nullable=true)
     */
    private $alurCommissionchargeacquereur;

    /**
     * @var float|null
     *
     * @ORM\Column(name="Alur_honoraires_locataire_VDB", type="float", precision=10, scale=0, nullable=true)
     */
    private $alurHonorairesLocataireVdb;

    /**
     * @var float|null
     *
     * @ORM\Column(name="Alur_honoraires_locataire_EDL", type="float", precision=10, scale=0, nullable=true)
     */
    private $alurHonorairesLocataireEdl;

    /**
     * @var float|null
     *
     * @ORM\Column(name="Alur_honoraires_acquereur_pourcent", type="float", precision=10, scale=0, nullable=true)
     */
    private $alurHonorairesAcquereurPourcent;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="Alur_copropriete", type="boolean", nullable=true)
     */
    private $alurCopropriete;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Alur_nb_lots", type="integer", nullable=true)
     */
    private $alurNbLots;

    /**
     * @var float|null
     *
     * @ORM\Column(name="Alur_budget_previsionnel", type="float", precision=10, scale=0, nullable=true)
     */
    private $alurBudgetPrevisionnel;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="Alur_procedure_1", type="boolean", nullable=true)
     */
    private $alurProcedure1;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="Alur_procedure_2", type="boolean", nullable=true)
     */
    private $alurProcedure2;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="Alur_procedure_3", type="boolean", nullable=true)
     */
    private $alurProcedure3;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PictFilename1", type="string", length=35, nullable=true)
     */
    private $pictfilename1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PictFilename2", type="string", length=35, nullable=true)
     */
    private $pictfilename2;

    /**
     * @var string
     *
     * @ORM\Column(name="PictFilename3", type="string", length=35, nullable=true)
     */
    private $pictfilename3;

    /**
     * @var string
     *
     * @ORM\Column(name="PictFilename4", type="string", length=35, nullable=true)
     */
    private $pictfilename4;

    /**
     * @var string
     *
     * @ORM\Column(name="PictFilename5", type="string", length=35, nullable=true)
     */
    private $pictfilename5;

    /**
     * @var string
     *
     * @ORM\Column(name="PictFilename6", type="string", length=35, nullable=true)
     */
    private $pictfilename6;

    /**
     * @var string
     *
     * @ORM\Column(name="PlanFilename", type="string", length=35, nullable=true)
     */
    private $planfilename;

    /**
     * @var string
     *
     * @ORM\Column(name="PlanFilename2", type="string", length=35, nullable=true)
     */
    private $planfilename2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="VillePub", type="string", length=35, nullable=true)
     */
    private $villepub;

    /**
     * @var string|null
     *
     * @ORM\Column(name="CodeDptPub", type="string", length=5, nullable=true)
     */
    private $codedptpub;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NomDptPub", type="string", length=35, nullable=true)
     */
    private $nomdptpub;

    /**
     * @var string|null
     *
     * @ORM\Column(name="CodePostalPub", type="string", length=5, nullable=true)
     */
    private $codepostalpub;

    /**
     * @return int
     */
    public function getCodereseau(): int
    {
        return $this->codereseau;
    }

    /**
     * @param int $codereseau
     * @return BienHermes
     */
    public function setCodereseau(int $codereseau): BienHermes
    {
        $this->codereseau = $codereseau;
        return $this;
    }

    /**
     * @return int
     */
    public function getCodeagence(): int
    {
        return $this->codeagence;
    }

    /**
     * @param int $codeagence
     * @return BienHermes
     */
    public function setCodeagence(int $codeagence): BienHermes
    {
        $this->codeagence = $codeagence;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumero(): int
    {
        return $this->numero;
    }

    /**
     * @param int $numero
     * @return BienHermes
     */
    public function setNumero(int $numero): BienHermes
    {
        $this->numero = $numero;
        return $this;
    }

    public function getId()
    {
        return $this->getCodeagence() . $this->getNumero();
    }

    /**
     * @return bool|null
     */
    public function getStatut(): ?bool
    {
        return $this->statut;
    }

    /**
     * @param bool|null $statut
     * @return BienHermes
     */
    public function setStatut(?bool $statut): BienHermes
    {
        $this->statut = $statut;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitreannonce(): ?string
    {
        return $this->titreannonce;
    }

    /**
     * @param string|null $titreannonce
     * @return BienHermes
     */
    public function setTitreannonce(?string $titreannonce): BienHermes
    {
        $this->titreannonce = $titreannonce;
        return $this;
    }

    public function getSlug(): string
    {
        return (new Slugify())->slugify($this->titreannonce);
    }

    /**
     * @return string|null
     */
    public function getAnnonce(): ?string
    {
        return $this->annonce;
    }

    /**
     * @param string|null $annonce
     * @return BienHermes
     */
    public function setAnnonce(?string $annonce): BienHermes
    {
        $this->annonce = $annonce;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getTop(): ?bool
    {
        return $this->top;
    }

    /**
     * @param bool|null $top
     * @return BienHermes
     */
    public function setTop(?bool $top): BienHermes
    {
        $this->top = $top;
        return $this;
    }

    /**
     * @return bool
     */
    public function isTypetransact(): bool
    {
        return $this->typetransact;
    }

    /**
     * @param bool $typetransact
     * @return BienHermes
     */
    public function setTypetransact(bool $typetransact): BienHermes
    {
        $this->typetransact = $typetransact;
        return $this;
    }

    public function getTransactionType () : string
    {
        return self::TYPETRANSACTION[$this->typetransact];
    }

    /**
     * @return int|null
     */
    public function getTypebien(): ?int
    {
        return $this->typebien;
    }

    /**
     * @param int|null $typebien
     * @return BienHermes
     */
    public function setTypebien(?int $typebien): BienHermes
    {
        $this->typebien = $typebien;
        return $this;
    }

    public function getBienType() : string
    {
        return self::TYPEBIEN[$this->typebien];
    }

    /**
     * @return int|null
     */
    public function getNumeromurs(): ?int
    {
        return $this->numeromurs;
    }

    /**
     * @param int|null $numeromurs
     * @return BienHermes
     */
    public function setNumeromurs(?int $numeromurs): BienHermes
    {
        $this->numeromurs = $numeromurs;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNegociateur(): ?string
    {
        return $this->negociateur;
    }

    /**
     * @param string|null $negociateur
     * @return BienHermes
     */
    public function setNegociateur(?string $negociateur): BienHermes
    {
        $this->negociateur = $negociateur;
        return $this;
    }

    /**
     * @return string
     */
    public function getDenomination(): string
    {
        return $this->denomination;
    }

    /**
     * @param string $denomination
     * @return BienHermes
     */
    public function setDenomination(string $denomination): BienHermes
    {
        $this->denomination = $denomination;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumvoie(): ?string
    {
        return $this->numvoie;
    }

    /**
     * @param string|null $numvoie
     * @return BienHermes
     */
    public function setNumvoie(?string $numvoie): BienHermes
    {
        $this->numvoie = $numvoie;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTypevoie(): ?string
    {
        return $this->typevoie;
    }

    /**
     * @param string|null $typevoie
     * @return BienHermes
     */
    public function setTypevoie(?string $typevoie): BienHermes
    {
        $this->typevoie = $typevoie;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNomvoie(): ?string
    {
        return $this->nomvoie;
    }

    /**
     * @param string|null $nomvoie
     * @return BienHermes
     */
    public function setNomvoie(?string $nomvoie): BienHermes
    {
        $this->nomvoie = $nomvoie;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSuiteadresse(): ?string
    {
        return $this->suiteadresse;
    }

    /**
     * @param string|null $suiteadresse
     * @return BienHermes
     */
    public function setSuiteadresse(?string $suiteadresse): BienHermes
    {
        $this->suiteadresse = $suiteadresse;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCodepostal(): ?string
    {
        return $this->codepostal;
    }

    /**
     * @param string|null $codepostal
     * @return BienHermes
     */
    public function setCodepostal(?string $codepostal): BienHermes
    {
        $this->codepostal = $codepostal;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getVille(): ?string
    {
        return $this->ville;
    }

    /**
     * @param string|null $ville
     * @return BienHermes
     */
    public function setVille(?string $ville): BienHermes
    {
        $this->ville = $ville;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    /**
     * @param string|null $telephone
     * @return BienHermes
     */
    public function setTelephone(?string $telephone): BienHermes
    {
        $this->telephone = $telephone;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFax(): ?string
    {
        return $this->fax;
    }

    /**
     * @param string|null $fax
     * @return BienHermes
     */
    public function setFax(?string $fax): BienHermes
    {
        $this->fax = $fax;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return BienHermes
     */
    public function setEmail(?string $email): BienHermes
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUidvendeur(): ?string
    {
        return $this->uidvendeur;
    }

    /**
     * @param string|null $uidvendeur
     * @return BienHermes
     */
    public function setUidvendeur(?string $uidvendeur): BienHermes
    {
        $this->uidvendeur = $uidvendeur;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUidadministrateur(): ?string
    {
        return $this->uidadministrateur;
    }

    /**
     * @param string|null $uidadministrateur
     * @return BienHermes
     */
    public function setUidadministrateur(?string $uidadministrateur): BienHermes
    {
        $this->uidadministrateur = $uidadministrateur;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUidmandataire(): ?string
    {
        return $this->uidmandataire;
    }

    /**
     * @param string|null $uidmandataire
     * @return BienHermes
     */
    public function setUidmandataire(?string $uidmandataire): BienHermes
    {
        $this->uidmandataire = $uidmandataire;
        return $this;
    }

    /**
     * @return string
     */
    public function getActivite(): string
    {
        return $this->activite;
    }

    /**
     * @param string $activite
     * @return BienHermes
     */
    public function setActivite(string $activite): BienHermes
    {
        $this->activite = $activite;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPrixpublic(): ?int
    {
        return $this->prixpublic;
    }

    /**
     * @param int|null $prixpublic
     * @return BienHermes
     */
    public function setPrixpublic(?int $prixpublic): BienHermes
    {
        $this->prixpublic = $prixpublic;
        return $this;
    }

    public function getFormattedPrice(): string
    {
        return number_format($this->prixpublic, 0, '', ' ');
    }

    /**
     * @return bool|null
     */
    public function getLicence(): ?bool
    {
        return $this->licence;
    }

    /**
     * @param bool|null $licence
     * @return BienHermes
     */
    public function setLicence(?bool $licence): BienHermes
    {
        $this->licence = $licence;
        return $this;
    }

    /**
     * @return string
     */
    public function getCategorie(): string
    {
        return $this->categorie;
    }

    /**
     * @param string $categorie
     * @return BienHermes
     */
    public function setCategorie(string $categorie): BienHermes
    {
        $this->categorie = $categorie;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getDroitaubail(): ?int
    {
        return $this->droitaubail;
    }

    /**
     * @param int|null $droitaubail
     * @return BienHermes
     */
    public function setDroitaubail(?int $droitaubail): BienHermes
    {
        $this->droitaubail = $droitaubail;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTypebail(): ?string
    {
        return $this->typebail;
    }

    /**
     * @param string|null $typebail
     * @return BienHermes
     */
    public function setTypebail(?string $typebail): BienHermes
    {
        $this->typebail = $typebail;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getLoyerannuel(): ?int
    {
        return $this->loyerannuel;
    }

    /**
     * @param int|null $loyerannuel
     * @return BienHermes
     */
    public function setLoyerannuel(?int $loyerannuel): BienHermes
    {
        $this->loyerannuel = $loyerannuel;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getNbpieceslogement(): ?int
    {
        return $this->nbpieceslogement;
    }

    /**
     * @param int|null $nbpieceslogement
     * @return BienHermes
     */
    public function setNbpieceslogement(?int $nbpieceslogement): BienHermes
    {
        $this->nbpieceslogement = $nbpieceslogement;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescriptiflogement(): ?string
    {
        return $this->descriptiflogement;
    }

    /**
     * @param string|null $descriptiflogement
     * @return BienHermes
     */
    public function setDescriptiflogement(?string $descriptiflogement): BienHermes
    {
        $this->descriptiflogement = $descriptiflogement;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getQuartier(): ?string
    {
        return $this->quartier;
    }

    /**
     * @param string|null $quartier
     * @return BienHermes
     */
    public function setQuartier(?string $quartier): BienHermes
    {
        $this->quartier = $quartier;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFermeturehebdo(): ?string
    {
        return $this->fermeturehebdo;
    }

    /**
     * @param string|null $fermeturehebdo
     * @return BienHermes
     */
    public function setFermeturehebdo(?string $fermeturehebdo): BienHermes
    {
        $this->fermeturehebdo = $fermeturehebdo;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getHoraires(): ?string
    {
        return $this->horaires;
    }

    /**
     * @param string|null $horaires
     * @return BienHermes
     */
    public function setHoraires(?string $horaires): BienHermes
    {
        $this->horaires = $horaires;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCongesannuel(): ?string
    {
        return $this->congesannuel;
    }

    /**
     * @param string|null $congesannuel
     * @return BienHermes
     */
    public function setCongesannuel(?string $congesannuel): BienHermes
    {
        $this->congesannuel = $congesannuel;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getNbemployes(): ?int
    {
        return $this->nbemployes;
    }

    /**
     * @param int|null $nbemployes
     * @return BienHermes
     */
    public function setNbemployes(?int $nbemployes): BienHermes
    {
        $this->nbemployes = $nbemployes;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getNbsaisonniers(): ?int
    {
        return $this->nbsaisonniers;
    }

    /**
     * @param int|null $nbsaisonniers
     * @return BienHermes
     */
    public function setNbsaisonniers(?int $nbsaisonniers): BienHermes
    {
        $this->nbsaisonniers = $nbsaisonniers;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getSurfacetotale(): ?int
    {
        return $this->surfacetotale;
    }

    /**
     * @param int|null $surfacetotale
     * @return BienHermes
     */
    public function setSurfacetotale(?int $surfacetotale): BienHermes
    {
        $this->surfacetotale = $surfacetotale;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDetailsurfaces(): ?string
    {
        return $this->detailsurfaces;
    }

    /**
     * @param string|null $detailsurfaces
     * @return BienHermes
     */
    public function setDetailsurfaces(?string $detailsurfaces): BienHermes
    {
        $this->detailsurfaces = $detailsurfaces;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getBienangle(): ?bool
    {
        return $this->bienangle;
    }

    /**
     * @param bool|null $bienangle
     * @return BienHermes
     */
    public function setBienangle(?bool $bienangle): BienHermes
    {
        $this->bienangle = $bienangle;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getLineairefacade(): ?int
    {
        return $this->lineairefacade;
    }

    /**
     * @param int|null $lineairefacade
     * @return BienHermes
     */
    public function setLineairefacade(?int $lineairefacade): BienHermes
    {
        $this->lineairefacade = $lineairefacade;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEtatlieux(): ?string
    {
        return $this->etatlieux;
    }

    /**
     * @param string|null $etatlieux
     * @return BienHermes
     */
    public function setEtatlieux(?string $etatlieux): BienHermes
    {
        $this->etatlieux = $etatlieux;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEtatmateriel(): ?string
    {
        return $this->etatmateriel;
    }

    /**
     * @param string|null $etatmateriel
     * @return BienHermes
     */
    public function setEtatmateriel(?string $etatmateriel): BienHermes
    {
        $this->etatmateriel = $etatmateriel;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCaht(): ?int
    {
        return $this->caht;
    }

    /**
     * @param int|null $caht
     * @return BienHermes
     */
    public function setCaht(?int $caht): BienHermes
    {
        $this->caht = $caht;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getAchatht(): ?int
    {
        return $this->achatht;
    }

    /**
     * @param int|null $achatht
     * @return BienHermes
     */
    public function setAchatht(?int $achatht): BienHermes
    {
        $this->achatht = $achatht;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getChargesexternes(): ?int
    {
        return $this->chargesexternes;
    }

    /**
     * @param int|null $chargesexternes
     * @return BienHermes
     */
    public function setChargesexternes(?int $chargesexternes): BienHermes
    {
        $this->chargesexternes = $chargesexternes;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getSalaires(): ?int
    {
        return $this->salaires;
    }

    /**
     * @param int|null $salaires
     * @return BienHermes
     */
    public function setSalaires(?int $salaires): BienHermes
    {
        $this->salaires = $salaires;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getChargessociales(): ?int
    {
        return $this->chargessociales;
    }

    /**
     * @param int|null $chargessociales
     * @return BienHermes
     */
    public function setChargessociales(?int $chargessociales): BienHermes
    {
        $this->chargessociales = $chargessociales;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getRbe(): ?int
    {
        return $this->rbe;
    }

    /**
     * @param int|null $rbe
     * @return BienHermes
     */
    public function setRbe(?int $rbe): BienHermes
    {
        $this->rbe = $rbe;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUidcomptable(): ?string
    {
        return $this->uidcomptable;
    }

    /**
     * @param string|null $uidcomptable
     * @return BienHermes
     */
    public function setUidcomptable(?string $uidcomptable): BienHermes
    {
        $this->uidcomptable = $uidcomptable;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getDroitentree(): ?int
    {
        return $this->droitentree;
    }

    /**
     * @param int|null $droitentree
     * @return BienHermes
     */
    public function setDroitentree(?int $droitentree): BienHermes
    {
        $this->droitentree = $droitentree;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getLoyerpossible(): ?int
    {
        return $this->loyerpossible;
    }

    /**
     * @param int|null $loyerpossible
     * @return BienHermes
     */
    public function setLoyerpossible(?int $loyerpossible): BienHermes
    {
        $this->loyerpossible = $loyerpossible;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getDivisible(): ?bool
    {
        return $this->divisible;
    }

    /**
     * @param bool|null $divisible
     * @return BienHermes
     */
    public function setDivisible(?bool $divisible): BienHermes
    {
        $this->divisible = $divisible;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMinimumdivisible(): ?int
    {
        return $this->minimumdivisible;
    }

    /**
     * @param int|null $minimumdivisible
     * @return BienHermes
     */
    public function setMinimumdivisible(?int $minimumdivisible): BienHermes
    {
        $this->minimumdivisible = $minimumdivisible;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getDespecialisation(): ?bool
    {
        return $this->despecialisation;
    }

    /**
     * @param bool|null $despecialisation
     * @return BienHermes
     */
    public function setDespecialisation(?bool $despecialisation): BienHermes
    {
        $this->despecialisation = $despecialisation;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDisponibilite(): ?string
    {
        return $this->disponibilite;
    }

    /**
     * @param string|null $disponibilite
     * @return BienHermes
     */
    public function setDisponibilite(?string $disponibilite): BienHermes
    {
        $this->disponibilite = $disponibilite;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPrixm2(): ?int
    {
        return $this->prixm2;
    }

    /**
     * @param int|null $prixm2
     * @return BienHermes
     */
    public function setPrixm2(?int $prixm2): BienHermes
    {
        $this->prixm2 = $prixm2;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDessertes(): ?string
    {
        return $this->dessertes;
    }

    /**
     * @param string|null $dessertes
     * @return BienHermes
     */
    public function setDessertes(?string $dessertes): BienHermes
    {
        $this->dessertes = $dessertes;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNotesdessertes(): ?string
    {
        return $this->notesdessertes;
    }

    /**
     * @param string|null $notesdessertes
     * @return BienHermes
     */
    public function setNotesdessertes(?string $notesdessertes): BienHermes
    {
        $this->notesdessertes = $notesdessertes;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getConstruction(): ?string
    {
        return $this->construction;
    }

    /**
     * @param string|null $construction
     * @return BienHermes
     */
    public function setConstruction(?string $construction): BienHermes
    {
        $this->construction = $construction;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getAnneeconstruction(): ?int
    {
        return $this->anneeconstruction;
    }

    /**
     * @param int|null $anneeconstruction
     * @return BienHermes
     */
    public function setAnneeconstruction(?int $anneeconstruction): BienHermes
    {
        $this->anneeconstruction = $anneeconstruction;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getArchitecture(): ?string
    {
        return $this->architecture;
    }

    /**
     * @param string|null $architecture
     * @return BienHermes
     */
    public function setArchitecture(?string $architecture): BienHermes
    {
        $this->architecture = $architecture;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNotesarchitecture(): ?string
    {
        return $this->notesarchitecture;
    }

    /**
     * @param string|null $notesarchitecture
     * @return BienHermes
     */
    public function setNotesarchitecture(?string $notesarchitecture): BienHermes
    {
        $this->notesarchitecture = $notesarchitecture;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEnergie(): ?string
    {
        return $this->energie;
    }

    /**
     * @param string|null $energie
     * @return BienHermes
     */
    public function setEnergie(?string $energie): BienHermes
    {
        $this->energie = $energie;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNotesenergie(): ?string
    {
        return $this->notesenergie;
    }

    /**
     * @param string|null $notesenergie
     * @return BienHermes
     */
    public function setNotesenergie(?string $notesenergie): BienHermes
    {
        $this->notesenergie = $notesenergie;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAmenagement(): ?string
    {
        return $this->amenagement;
    }

    /**
     * @param string|null $amenagement
     * @return BienHermes
     */
    public function setAmenagement(?string $amenagement): BienHermes
    {
        $this->amenagement = $amenagement;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCablage(): ?string
    {
        return $this->cablage;
    }

    /**
     * @param string|null $cablage
     * @return BienHermes
     */
    public function setCablage(?string $cablage): BienHermes
    {
        $this->cablage = $cablage;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNotesbureau(): ?string
    {
        return $this->notesbureau;
    }

    /**
     * @param string|null $notesbureau
     * @return BienHermes
     */
    public function setNotesbureau(?string $notesbureau): BienHermes
    {
        $this->notesbureau = $notesbureau;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNotesie(): ?string
    {
        return $this->notesie;
    }

    /**
     * @param string|null $notesie
     * @return BienHermes
     */
    public function setNotesie(?string $notesie): BienHermes
    {
        $this->notesie = $notesie;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSpecialite(): ?string
    {
        return $this->specialite;
    }

    /**
     * @param string|null $specialite
     * @return BienHermes
     */
    public function setSpecialite(?string $specialite): BienHermes
    {
        $this->specialite = $specialite;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getNbplaces(): ?int
    {
        return $this->nbplaces;
    }

    /**
     * @param int|null $nbplaces
     * @return BienHermes
     */
    public function setNbplaces(?int $nbplaces): BienHermes
    {
        $this->nbplaces = $nbplaces;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getTerrasse(): ?int
    {
        return $this->terrasse;
    }

    /**
     * @param int|null $terrasse
     * @return BienHermes
     */
    public function setTerrasse(?int $terrasse): BienHermes
    {
        $this->terrasse = $terrasse;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getNbcouvertsmidi(): ?int
    {
        return $this->nbcouvertsmidi;
    }

    /**
     * @param int|null $nbcouvertsmidi
     * @return BienHermes
     */
    public function setNbcouvertsmidi(?int $nbcouvertsmidi): BienHermes
    {
        $this->nbcouvertsmidi = $nbcouvertsmidi;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getNbcouvertssoir(): ?int
    {
        return $this->nbcouvertssoir;
    }

    /**
     * @param int|null $nbcouvertssoir
     * @return BienHermes
     */
    public function setNbcouvertssoir(?int $nbcouvertssoir): BienHermes
    {
        $this->nbcouvertssoir = $nbcouvertssoir;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getRecettejour(): ?int
    {
        return $this->recettejour;
    }

    /**
     * @param int|null $recettejour
     * @return BienHermes
     */
    public function setRecettejour(?int $recettejour): BienHermes
    {
        $this->recettejour = $recettejour;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getHecto(): ?int
    {
        return $this->hecto;
    }

    /**
     * @param int|null $hecto
     * @return BienHermes
     */
    public function setHecto(?int $hecto): BienHermes
    {
        $this->hecto = $hecto;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getNbkgscafe(): ?int
    {
        return $this->nbkgscafe;
    }

    /**
     * @param int|null $nbkgscafe
     * @return BienHermes
     */
    public function setNbkgscafe(?int $nbkgscafe): BienHermes
    {
        $this->nbkgscafe = $nbkgscafe;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNoteschr(): ?string
    {
        return $this->noteschr;
    }

    /**
     * @param string|null $noteschr
     * @return BienHermes
     */
    public function setNoteschr(?string $noteschr): BienHermes
    {
        $this->noteschr = $noteschr;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getRemtabac(): ?int
    {
        return $this->remtabac;
    }

    /**
     * @param int|null $remtabac
     * @return BienHermes
     */
    public function setRemtabac(?int $remtabac): BienHermes
    {
        $this->remtabac = $remtabac;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getRemloto(): ?int
    {
        return $this->remloto;
    }

    /**
     * @param int|null $remloto
     * @return BienHermes
     */
    public function setRemloto(?int $remloto): BienHermes
    {
        $this->remloto = $remloto;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getRempmu(): ?int
    {
        return $this->rempmu;
    }

    /**
     * @param int|null $rempmu
     * @return BienHermes
     */
    public function setRempmu(?int $rempmu): BienHermes
    {
        $this->rempmu = $rempmu;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getRemloterie(): ?int
    {
        return $this->remloterie;
    }

    /**
     * @param int|null $remloterie
     * @return BienHermes
     */
    public function setRemloterie(?int $remloterie): BienHermes
    {
        $this->remloterie = $remloterie;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getRempresse(): ?int
    {
        return $this->rempresse;
    }

    /**
     * @param int|null $rempresse
     * @return BienHermes
     */
    public function setRempresse(?int $rempresse): BienHermes
    {
        $this->rempresse = $rempresse;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getRemjeux(): ?int
    {
        return $this->remjeux;
    }

    /**
     * @param int|null $remjeux
     * @return BienHermes
     */
    public function setRemjeux(?int $remjeux): BienHermes
    {
        $this->remjeux = $remjeux;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getRemautres(): ?int
    {
        return $this->remautres;
    }

    /**
     * @param int|null $remautres
     * @return BienHermes
     */
    public function setRemautres(?int $remautres): BienHermes
    {
        $this->remautres = $remautres;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCatabletterie(): ?int
    {
        return $this->catabletterie;
    }

    /**
     * @param int|null $catabletterie
     * @return BienHermes
     */
    public function setCatabletterie(?int $catabletterie): BienHermes
    {
        $this->catabletterie = $catabletterie;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCacartes(): ?int
    {
        return $this->cacartes;
    }

    /**
     * @param int|null $cacartes
     * @return BienHermes
     */
    public function setCacartes(?int $cacartes): BienHermes
    {
        $this->cacartes = $cacartes;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCatimbres(): ?int
    {
        return $this->catimbres;
    }

    /**
     * @param int|null $catimbres
     * @return BienHermes
     */
    public function setCatimbres(?int $catimbres): BienHermes
    {
        $this->catimbres = $catimbres;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCaautres(): ?int
    {
        return $this->caautres;
    }

    /**
     * @param int|null $caautres
     * @return BienHermes
     */
    public function setCaautres(?int $caautres): BienHermes
    {
        $this->caautres = $caautres;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getMachcafedepot(): ?bool
    {
        return $this->machcafedepot;
    }

    /**
     * @param bool|null $machcafedepot
     * @return BienHermes
     */
    public function setMachcafedepot(?bool $machcafedepot): BienHermes
    {
        $this->machcafedepot = $machcafedepot;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCategoriehotel(): ?string
    {
        return $this->categoriehotel;
    }

    /**
     * @param string|null $categoriehotel
     * @return BienHermes
     */
    public function setCategoriehotel(?string $categoriehotel): BienHermes
    {
        $this->categoriehotel = $categoriehotel;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getNbchambressimples(): ?int
    {
        return $this->nbchambressimples;
    }

    /**
     * @param int|null $nbchambressimples
     * @return BienHermes
     */
    public function setNbchambressimples(?int $nbchambressimples): BienHermes
    {
        $this->nbchambressimples = $nbchambressimples;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBecpression(): ?string
    {
        return $this->becpression;
    }

    /**
     * @param string|null $becpression
     * @return BienHermes
     */
    public function setBecpression(?string $becpression): BienHermes
    {
        $this->becpression = $becpression;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getNbchambresdoubles(): ?int
    {
        return $this->nbchambresdoubles;
    }

    /**
     * @param int|null $nbchambresdoubles
     * @return BienHermes
     */
    public function setNbchambresdoubles(?int $nbchambresdoubles): BienHermes
    {
        $this->nbchambresdoubles = $nbchambresdoubles;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getTauxremplissage(): ?int
    {
        return $this->tauxremplissage;
    }

    /**
     * @param int|null $tauxremplissage
     * @return BienHermes
     */
    public function setTauxremplissage(?int $tauxremplissage): BienHermes
    {
        $this->tauxremplissage = $tauxremplissage;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getNbplacessa(): ?int
    {
        return $this->nbplacessa;
    }

    /**
     * @param int|null $nbplacessa
     * @return BienHermes
     */
    public function setNbplacessa(?int $nbplacessa): BienHermes
    {
        $this->nbplacessa = $nbplacessa;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getNbplacesspdj(): ?int
    {
        return $this->nbplacesspdj;
    }

    /**
     * @param int|null $nbplacesspdj
     * @return BienHermes
     */
    public function setNbplacesspdj(?int $nbplacesspdj): BienHermes
    {
        $this->nbplacesspdj = $nbplacesspdj;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getNbplacespk(): ?int
    {
        return $this->nbplacespk;
    }

    /**
     * @param int|null $nbplacespk
     * @return BienHermes
     */
    public function setNbplacespk(?int $nbplacespk): BienHermes
    {
        $this->nbplacespk = $nbplacespk;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getNbsallesreunion(): ?int
    {
        return $this->nbsallesreunion;
    }

    /**
     * @param int|null $nbsallesreunion
     * @return BienHermes
     */
    public function setNbsallesreunion(?int $nbsallesreunion): BienHermes
    {
        $this->nbsallesreunion = $nbsallesreunion;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCapacitesallereunion(): ?int
    {
        return $this->capacitesallereunion;
    }

    /**
     * @param int|null $capacitesallereunion
     * @return BienHermes
     */
    public function setCapacitesallereunion(?int $capacitesallereunion): BienHermes
    {
        $this->capacitesallereunion = $capacitesallereunion;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getDiscotheque(): ?int
    {
        return $this->discotheque;
    }

    /**
     * @param int|null $discotheque
     * @return BienHermes
     */
    public function setDiscotheque(?int $discotheque): BienHermes
    {
        $this->discotheque = $discotheque;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCasino(): ?int
    {
        return $this->casino;
    }

    /**
     * @param int|null $casino
     * @return BienHermes
     */
    public function setCasino(?int $casino): BienHermes
    {
        $this->casino = $casino;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getSallemassage(): ?int
    {
        return $this->sallemassage;
    }

    /**
     * @param int|null $sallemassage
     * @return BienHermes
     */
    public function setSallemassage(?int $sallemassage): BienHermes
    {
        $this->sallemassage = $sallemassage;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getSallegymnastique(): ?int
    {
        return $this->sallegymnastique;
    }

    /**
     * @param int|null $sallegymnastique
     * @return BienHermes
     */
    public function setSallegymnastique(?int $sallegymnastique): BienHermes
    {
        $this->sallegymnastique = $sallegymnastique;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPiscine(): ?int
    {
        return $this->piscine;
    }

    /**
     * @param int|null $piscine
     * @return BienHermes
     */
    public function setPiscine(?int $piscine): BienHermes
    {
        $this->piscine = $piscine;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getNbtennis(): ?int
    {
        return $this->nbtennis;
    }

    /**
     * @param int|null $nbtennis
     * @return BienHermes
     */
    public function setNbtennis(?int $nbtennis): BienHermes
    {
        $this->nbtennis = $nbtennis;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getGolf(): ?int
    {
        return $this->golf;
    }

    /**
     * @param int|null $golf
     * @return BienHermes
     */
    public function setGolf(?int $golf): BienHermes
    {
        $this->golf = $golf;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNoteshotel(): ?string
    {
        return $this->noteshotel;
    }

    /**
     * @param string|null $noteshotel
     * @return BienHermes
     */
    public function setNoteshotel(?string $noteshotel): BienHermes
    {
        $this->noteshotel = $noteshotel;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCaboulangerie(): ?int
    {
        return $this->caboulangerie;
    }

    /**
     * @param int|null $caboulangerie
     * @return BienHermes
     */
    public function setCaboulangerie(?int $caboulangerie): BienHermes
    {
        $this->caboulangerie = $caboulangerie;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCapatisserie(): ?int
    {
        return $this->capatisserie;
    }

    /**
     * @param int|null $capatisserie
     * @return BienHermes
     */
    public function setCapatisserie(?int $capatisserie): BienHermes
    {
        $this->capatisserie = $capatisserie;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCatraiteur(): ?int
    {
        return $this->catraiteur;
    }

    /**
     * @param int|null $catraiteur
     * @return BienHermes
     */
    public function setCatraiteur(?int $catraiteur): BienHermes
    {
        $this->catraiteur = $catraiteur;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCasandwicherie(): ?int
    {
        return $this->casandwicherie;
    }

    /**
     * @param int|null $casandwicherie
     * @return BienHermes
     */
    public function setCasandwicherie(?int $casandwicherie): BienHermes
    {
        $this->casandwicherie = $casandwicherie;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCaconfiserie(): ?int
    {
        return $this->caconfiserie;
    }

    /**
     * @param int|null $caconfiserie
     * @return BienHermes
     */
    public function setCaconfiserie(?int $caconfiserie): BienHermes
    {
        $this->caconfiserie = $caconfiserie;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCaglacier(): ?int
    {
        return $this->caglacier;
    }

    /**
     * @param int|null $caglacier
     * @return BienHermes
     */
    public function setCaglacier(?int $caglacier): BienHermes
    {
        $this->caglacier = $caglacier;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCachocolatier(): ?int
    {
        return $this->cachocolatier;
    }

    /**
     * @param int|null $cachocolatier
     * @return BienHermes
     */
    public function setCachocolatier(?int $cachocolatier): BienHermes
    {
        $this->cachocolatier = $cachocolatier;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNotesbpct(): ?string
    {
        return $this->notesbpct;
    }

    /**
     * @param string|null $notesbpct
     * @return BienHermes
     */
    public function setNotesbpct(?string $notesbpct): BienHermes
    {
        $this->notesbpct = $notesbpct;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMontantstock(): ?int
    {
        return $this->montantstock;
    }

    /**
     * @param int|null $montantstock
     * @return BienHermes
     */
    public function setMontantstock(?int $montantstock): BienHermes
    {
        $this->montantstock = $montantstock;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNotesac(): ?string
    {
        return $this->notesac;
    }

    /**
     * @param string|null $notesac
     * @return BienHermes
     */
    public function setNotesac(?string $notesac): BienHermes
    {
        $this->notesac = $notesac;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNotesnego(): ?string
    {
        return $this->notesnego;
    }

    /**
     * @param string|null $notesnego
     * @return BienHermes
     */
    public function setNotesnego(?string $notesnego): BienHermes
    {
        $this->notesnego = $notesnego;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getVisitcounter(): ?int
    {
        return $this->visitcounter;
    }

    /**
     * @param int|null $visitcounter
     * @return BienHermes
     */
    public function setVisitcounter(?int $visitcounter): BienHermes
    {
        $this->visitcounter = $visitcounter;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getNbbungalows(): ?int
    {
        return $this->nbbungalows;
    }

    /**
     * @param int|null $nbbungalows
     * @return BienHermes
     */
    public function setNbbungalows(?int $nbbungalows): BienHermes
    {
        $this->nbbungalows = $nbbungalows;
        return $this;
    }

    /**
     * @return bool
     */
    public function isBnaxos(): bool
    {
        return $this->bnaxos;
    }

    /**
     * @param bool $bnaxos
     * @return BienHermes
     */
    public function setBnaxos(bool $bnaxos): BienHermes
    {
        $this->bnaxos = $bnaxos;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getTenudepuis(): ?\DateTime
    {
        return $this->tenudepuis;
    }

    /**
     * @param \DateTime|null $tenudepuis
     * @return BienHermes
     */
    public function setTenudepuis(?\DateTime $tenudepuis): BienHermes
    {
        $this->tenudepuis = $tenudepuis;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getNbetage(): ?int
    {
        return $this->nbetage;
    }

    /**
     * @param int|null $nbetage
     * @return BienHermes
     */
    public function setNbetage(?int $nbetage): BienHermes
    {
        $this->nbetage = $nbetage;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getSurfacesol(): ?int
    {
        return $this->surfacesol;
    }

    /**
     * @param int|null $surfacesol
     * @return BienHermes
     */
    public function setSurfacesol(?int $surfacesol): BienHermes
    {
        $this->surfacesol = $surfacesol;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getNbchambres(): ?int
    {
        return $this->nbchambres;
    }

    /**
     * @param int|null $nbchambres
     * @return BienHermes
     */
    public function setNbchambres(?int $nbchambres): BienHermes
    {
        $this->nbchambres = $nbchambres;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getNbplacesassises(): ?int
    {
        return $this->nbplacesassises;
    }

    /**
     * @param int|null $nbplacesassises
     * @return BienHermes
     */
    public function setNbplacesassises(?int $nbplacesassises): BienHermes
    {
        $this->nbplacesassises = $nbplacesassises;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getNbplacesterrasse(): ?int
    {
        return $this->nbplacesterrasse;
    }

    /**
     * @param int|null $nbplacesterrasse
     * @return BienHermes
     */
    public function setNbplacesterrasse(?int $nbplacesterrasse): BienHermes
    {
        $this->nbplacesterrasse = $nbplacesterrasse;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getNbplacesbar(): ?int
    {
        return $this->nbplacesbar;
    }

    /**
     * @param int|null $nbplacesbar
     * @return BienHermes
     */
    public function setNbplacesbar(?int $nbplacesbar): BienHermes
    {
        $this->nbplacesbar = $nbplacesbar;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTypeemplacement(): ?string
    {
        return $this->typeemplacement;
    }

    /**
     * @param string|null $typeemplacement
     * @return BienHermes
     */
    public function setTypeemplacement(?string $typeemplacement): BienHermes
    {
        $this->typeemplacement = $typeemplacement;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getClimatisation(): ?bool
    {
        return $this->climatisation;
    }

    /**
     * @param bool|null $climatisation
     * @return BienHermes
     */
    public function setClimatisation(?bool $climatisation): BienHermes
    {
        $this->climatisation = $climatisation;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getChargesol(): ?int
    {
        return $this->chargesol;
    }

    /**
     * @param int|null $chargesol
     * @return BienHermes
     */
    public function setChargesol(?int $chargesol): BienHermes
    {
        $this->chargesol = $chargesol;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getHauteursouspoutres(): ?string
    {
        return $this->hauteursouspoutres;
    }

    /**
     * @param string|null $hauteursouspoutres
     * @return BienHermes
     */
    public function setHauteursouspoutres(?string $hauteursouspoutres): BienHermes
    {
        $this->hauteursouspoutres = $hauteursouspoutres;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getNbportequai(): ?int
    {
        return $this->nbportequai;
    }

    /**
     * @param int|null $nbportequai
     * @return BienHermes
     */
    public function setNbportequai(?int $nbportequai): BienHermes
    {
        $this->nbportequai = $nbportequai;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getTaxefonciere(): ?int
    {
        return $this->taxefonciere;
    }

    /**
     * @param int|null $taxefonciere
     * @return BienHermes
     */
    public function setTaxefonciere(?int $taxefonciere): BienHermes
    {
        $this->taxefonciere = $taxefonciere;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getTaxebureau(): ?int
    {
        return $this->taxebureau;
    }

    /**
     * @param int|null $taxebureau
     * @return BienHermes
     */
    public function setTaxebureau(?int $taxebureau): BienHermes
    {
        $this->taxebureau = $taxebureau;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getQuintauxfarine(): ?int
    {
        return $this->quintauxfarine;
    }

    /**
     * @param int|null $quintauxfarine
     * @return BienHermes
     */
    public function setQuintauxfarine(?int $quintauxfarine): BienHermes
    {
        $this->quintauxfarine = $quintauxfarine;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getChargeslocativesmois(): ?string
    {
        return $this->chargeslocativesmois;
    }

    /**
     * @param string|null $chargeslocativesmois
     * @return BienHermes
     */
    public function setChargeslocativesmois(?string $chargeslocativesmois): BienHermes
    {
        $this->chargeslocativesmois = $chargeslocativesmois;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCommtotales(): ?int
    {
        return $this->commtotales;
    }

    /**
     * @param int|null $commtotales
     * @return BienHermes
     */
    public function setCommtotales(?int $commtotales): BienHermes
    {
        $this->commtotales = $commtotales;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCahtrestaurant(): ?int
    {
        return $this->cahtrestaurant;
    }

    /**
     * @param int|null $cahtrestaurant
     * @return BienHermes
     */
    public function setCahtrestaurant(?int $cahtrestaurant): BienHermes
    {
        $this->cahtrestaurant = $cahtrestaurant;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCahtbar(): ?int
    {
        return $this->cahtbar;
    }

    /**
     * @param int|null $cahtbar
     * @return BienHermes
     */
    public function setCahtbar(?int $cahtbar): BienHermes
    {
        $this->cahtbar = $cahtbar;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCahthotellerie(): ?int
    {
        return $this->cahthotellerie;
    }

    /**
     * @param int|null $cahthotellerie
     * @return BienHermes
     */
    public function setCahthotellerie(?int $cahthotellerie): BienHermes
    {
        $this->cahthotellerie = $cahthotellerie;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCahtrestauration(): ?int
    {
        return $this->cahtrestauration;
    }

    /**
     * @param int|null $cahtrestauration
     * @return BienHermes
     */
    public function setCahtrestauration(?int $cahtrestauration): BienHermes
    {
        $this->cahtrestauration = $cahtrestauration;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCahtdivers(): ?int
    {
        return $this->cahtdivers;
    }

    /**
     * @param int|null $cahtdivers
     * @return BienHermes
     */
    public function setCahtdivers(?int $cahtdivers): BienHermes
    {
        $this->cahtdivers = $cahtdivers;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCahtaemporter(): ?int
    {
        return $this->cahtaemporter;
    }

    /**
     * @param int|null $cahtaemporter
     * @return BienHermes
     */
    public function setCahtaemporter(?int $cahtaemporter): BienHermes
    {
        $this->cahtaemporter = $cahtaemporter;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCahtcoiffure(): ?int
    {
        return $this->cahtcoiffure;
    }

    /**
     * @param int|null $cahtcoiffure
     * @return BienHermes
     */
    public function setCahtcoiffure(?int $cahtcoiffure): BienHermes
    {
        $this->cahtcoiffure = $cahtcoiffure;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCahtesthetique(): ?int
    {
        return $this->cahtesthetique;
    }

    /**
     * @param int|null $cahtesthetique
     * @return BienHermes
     */
    public function setCahtesthetique(?int $cahtesthetique): BienHermes
    {
        $this->cahtesthetique = $cahtesthetique;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPerf(): ?int
    {
        return $this->perf;
    }

    /**
     * @param int|null $perf
     * @return BienHermes
     */
    public function setPerf(?int $perf): BienHermes
    {
        $this->perf = $perf;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLettredpe(): ?string
    {
        return $this->lettredpe;
    }

    /**
     * @param string|null $lettredpe
     * @return BienHermes
     */
    public function setLettredpe(?string $lettredpe): BienHermes
    {
        $this->lettredpe = $lettredpe;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getValeurdpe(): ?int
    {
        return $this->valeurdpe;
    }

    /**
     * @param int|null $valeurdpe
     * @return BienHermes
     */
    public function setValeurdpe(?int $valeurdpe): BienHermes
    {
        $this->valeurdpe = $valeurdpe;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLettreges(): ?string
    {
        return $this->lettreges;
    }

    /**
     * @param string|null $lettreges
     * @return BienHermes
     */
    public function setLettreges(?string $lettreges): BienHermes
    {
        $this->lettreges = $lettreges;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getValeurges(): ?int
    {
        return $this->valeurges;
    }

    /**
     * @param int|null $valeurges
     * @return BienHermes
     */
    public function setValeurges(?int $valeurges): BienHermes
    {
        $this->valeurges = $valeurges;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getNonsoumisdpe(): ?bool
    {
        return $this->nonsoumisdpe;
    }

    /**
     * @param bool|null $nonsoumisdpe
     * @return BienHermes
     */
    public function setNonsoumisdpe(?bool $nonsoumisdpe): BienHermes
    {
        $this->nonsoumisdpe = $nonsoumisdpe;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getDpeencours(): ?bool
    {
        return $this->dpeencours;
    }

    /**
     * @param bool|null $dpeencours
     * @return BienHermes
     */
    public function setDpeencours(?bool $dpeencours): BienHermes
    {
        $this->dpeencours = $dpeencours;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNouvelleenseigne(): ?string
    {
        return $this->nouvelleenseigne;
    }

    /**
     * @param string|null $nouvelleenseigne
     * @return BienHermes
     */
    public function setNouvelleenseigne(?string $nouvelleenseigne): BienHermes
    {
        $this->nouvelleenseigne = $nouvelleenseigne;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhototransaction(): ?string
    {
        return $this->phototransaction;
    }

    /**
     * @param string|null $phototransaction
     * @return BienHermes
     */
    public function setPhototransaction(?string $phototransaction): BienHermes
    {
        $this->phototransaction = $phototransaction;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNotenouvelleenseigne(): ?string
    {
        return $this->notenouvelleenseigne;
    }

    /**
     * @param string|null $notenouvelleenseigne
     * @return BienHermes
     */
    public function setNotenouvelleenseigne(?string $notenouvelleenseigne): BienHermes
    {
        $this->notenouvelleenseigne = $notenouvelleenseigne;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTypemandat(): ?string
    {
        return $this->typemandat;
    }

    /**
     * @param string|null $typemandat
     * @return BienHermes
     */
    public function setTypemandat(?string $typemandat): BienHermes
    {
        $this->typemandat = $typemandat;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumeromandat(): ?string
    {
        return $this->numeromandat;
    }

    /**
     * @param string|null $numeromandat
     * @return BienHermes
     */
    public function setNumeromandat(?string $numeromandat): BienHermes
    {
        $this->numeromandat = $numeromandat;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSiretrcs(): ?string
    {
        return $this->siretrcs;
    }

    /**
     * @param string|null $siretrcs
     * @return BienHermes
     */
    public function setSiretrcs(?string $siretrcs): BienHermes
    {
        $this->siretrcs = $siretrcs;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAlurCommissionchargeacquereur(): ?bool
    {
        return $this->alurCommissionchargeacquereur;
    }

    /**
     * @param bool|null $alurCommissionchargeacquereur
     * @return BienHermes
     */
    public function setAlurCommissionchargeacquereur(?bool $alurCommissionchargeacquereur): BienHermes
    {
        $this->alurCommissionchargeacquereur = $alurCommissionchargeacquereur;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getAlurHonorairesLocataireVdb(): ?float
    {
        return $this->alurHonorairesLocataireVdb;
    }

    /**
     * @param float|null $alurHonorairesLocataireVdb
     * @return BienHermes
     */
    public function setAlurHonorairesLocataireVdb(?float $alurHonorairesLocataireVdb): BienHermes
    {
        $this->alurHonorairesLocataireVdb = $alurHonorairesLocataireVdb;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getAlurHonorairesLocataireEdl(): ?float
    {
        return $this->alurHonorairesLocataireEdl;
    }

    /**
     * @param float|null $alurHonorairesLocataireEdl
     * @return BienHermes
     */
    public function setAlurHonorairesLocataireEdl(?float $alurHonorairesLocataireEdl): BienHermes
    {
        $this->alurHonorairesLocataireEdl = $alurHonorairesLocataireEdl;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getAlurHonorairesAcquereurPourcent(): ?float
    {
        return $this->alurHonorairesAcquereurPourcent;
    }

    /**
     * @param float|null $alurHonorairesAcquereurPourcent
     * @return BienHermes
     */
    public function setAlurHonorairesAcquereurPourcent(?float $alurHonorairesAcquereurPourcent): BienHermes
    {
        $this->alurHonorairesAcquereurPourcent = $alurHonorairesAcquereurPourcent;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAlurCopropriete(): ?bool
    {
        return $this->alurCopropriete;
    }

    /**
     * @param bool|null $alurCopropriete
     * @return BienHermes
     */
    public function setAlurCopropriete(?bool $alurCopropriete): BienHermes
    {
        $this->alurCopropriete = $alurCopropriete;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getAlurNbLots(): ?int
    {
        return $this->alurNbLots;
    }

    /**
     * @param int|null $alurNbLots
     * @return BienHermes
     */
    public function setAlurNbLots(?int $alurNbLots): BienHermes
    {
        $this->alurNbLots = $alurNbLots;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getAlurBudgetPrevisionnel(): ?float
    {
        return $this->alurBudgetPrevisionnel;
    }

    /**
     * @param float|null $alurBudgetPrevisionnel
     * @return BienHermes
     */
    public function setAlurBudgetPrevisionnel(?float $alurBudgetPrevisionnel): BienHermes
    {
        $this->alurBudgetPrevisionnel = $alurBudgetPrevisionnel;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAlurProcedure1(): ?bool
    {
        return $this->alurProcedure1;
    }

    /**
     * @param bool|null $alurProcedure1
     * @return BienHermes
     */
    public function setAlurProcedure1(?bool $alurProcedure1): BienHermes
    {
        $this->alurProcedure1 = $alurProcedure1;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAlurProcedure2(): ?bool
    {
        return $this->alurProcedure2;
    }

    /**
     * @param bool|null $alurProcedure2
     * @return BienHermes
     */
    public function setAlurProcedure2(?bool $alurProcedure2): BienHermes
    {
        $this->alurProcedure2 = $alurProcedure2;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAlurProcedure3(): ?bool
    {
        return $this->alurProcedure3;
    }

    /**
     * @param bool|null $alurProcedure3
     * @return BienHermes
     */
    public function setAlurProcedure3(?bool $alurProcedure3): BienHermes
    {
        $this->alurProcedure3 = $alurProcedure3;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPictfilename1(): ?string
    {
        return $this->pictfilename1;
    }

    /**
     * @param string|null $pictfilename1
     * @return BienHermes
     */
    public function setPictfilename1(?string $pictfilename1): BienHermes
    {
        $this->pictfilename1 = $pictfilename1;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPictfilename2(): ?string
    {
        return $this->pictfilename2;
    }

    /**
     * @param string|null $pictfilename2
     * @return BienHermes
     */
    public function setPictfilename2(?string $pictfilename2): BienHermes
    {
        $this->pictfilename2 = $pictfilename2;
        return $this;
    }

    /**
     * @return string
     */
    public function getPictfilename3(): string
    {
        return $this->pictfilename3;
    }

    /**
     * @param string $pictfilename3
     * @return BienHermes
     */
    public function setPictfilename3(string $pictfilename3): BienHermes
    {
        $this->pictfilename3 = $pictfilename3;
        return $this;
    }

    /**
     * @return string
     */
    public function getPictfilename4(): string
    {
        return $this->pictfilename4;
    }

    /**
     * @param string $pictfilename4
     * @return BienHermes
     */
    public function setPictfilename4(string $pictfilename4): BienHermes
    {
        $this->pictfilename4 = $pictfilename4;
        return $this;
    }

    /**
     * @return string
     */
    public function getPictfilename5(): string
    {
        return $this->pictfilename5;
    }

    /**
     * @param string $pictfilename5
     * @return BienHermes
     */
    public function setPictfilename5(string $pictfilename5): BienHermes
    {
        $this->pictfilename5 = $pictfilename5;
        return $this;
    }

    /**
     * @return string
     */
    public function getPictfilename6(): string
    {
        return $this->pictfilename6;
    }

    /**
     * @param string $pictfilename6
     * @return BienHermes
     */
    public function setPictfilename6(string $pictfilename6): BienHermes
    {
        $this->pictfilename6 = $pictfilename6;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlanfilename(): string
    {
        return $this->planfilename;
    }

    /**
     * @param string $planfilename
     * @return BienHermes
     */
    public function setPlanfilename(string $planfilename): BienHermes
    {
        $this->planfilename = $planfilename;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlanfilename2(): string
    {
        return $this->planfilename2;
    }

    /**
     * @param string $planfilename2
     * @return BienHermes
     */
    public function setPlanfilename2(string $planfilename2): BienHermes
    {
        $this->planfilename2 = $planfilename2;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getVillepub(): ?string
    {
        return $this->villepub;
    }

    /**
     * @param string|null $villepub
     * @return BienHermes
     */
    public function setVillepub(?string $villepub): BienHermes
    {
        $this->villepub = $villepub;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCodedptpub(): ?string
    {
        return $this->codedptpub;
    }

    /**
     * @param string|null $codedptpub
     * @return BienHermes
     */
    public function setCodedptpub(?string $codedptpub): BienHermes
    {
        $this->codedptpub = $codedptpub;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNomdptpub(): ?string
    {
        return $this->nomdptpub;
    }

    /**
     * @param string|null $nomdptpub
     * @return BienHermes
     */
    public function setNomdptpub(?string $nomdptpub): BienHermes
    {
        $this->nomdptpub = $nomdptpub;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCodepostalpub(): ?string
    {
        return $this->codepostalpub;
    }

    /**
     * @param string|null $codepostalpub
     * @return BienHermes
     */
    public function setCodepostalpub(?string $codepostalpub): BienHermes
    {
        $this->codepostalpub = $codepostalpub;
        return $this;
    }



}
