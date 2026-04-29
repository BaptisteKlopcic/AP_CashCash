public class Materiel {
    private String numSerie;
    private TypeMateriel type;
    private FamilleMateriel famille;
    private int quantite;
    private LocalDate dateVente;
    private LocalDate dateInstallation;
    private double prixVente;
    private String emplacement;
    private long nbJourAvantEcheance; // Calculé si le matériel est sous contrat
}

public interface MaterielDAO {
    List<Materiel> getMaterielsSousContrat(String idClient) throws SQLException;
    List<Materiel> getMaterielsHorsContrat(String idClient) throws SQLException;
}

/**
 * Classe utilitaire permettant de générer un fichier XML pour un client.
 */
public class XmlMaterielGenerator {

    /**
     * Génère un fichier XML contenant les matériels d’un client.
     *
     * @param idClient identifiant du client
     * @param sousContrat liste des matériels sous contrat
     * @param horsContrat liste des matériels hors contrat
     * @param outputFile fichier XML à écrire
     * @throws Exception si une erreur survient lors de la génération
     */
    public static void genererXmlClient(String idClient,
                                        List<Materiel> sousContrat,
                                        List<Materiel> horsContrat,
                                        File outputFile) throws Exception {

        DocumentBuilderFactory factory = DocumentBuilderFactory.newInstance();
        DocumentBuilder builder = factory.newDocumentBuilder();
        Document doc = builder.newDocument();

        // Racine <listeMateriel>
        Element racine = doc.createElement("listeMateriel");
        doc.appendChild(racine);

        // Élément <materiels idClient="...">
        Element elMateriels = doc.createElement("materiels");
        elMateriels.setAttribute("idClient", idClient);
        racine.appendChild(elMateriels);

        // Sous-contrat
        Element elSousContrat = doc.createElement("sousContrat");
        elMateriels.appendChild(elSousContrat);
        ajouterMateriels(doc, elSousContrat, sousContrat);

        // Hors contrat
        Element elHorsContrat = doc.createElement("horsContrat");
        elMateriels.appendChild(elHorsContrat);
        ajouterMateriels(doc, elHorsContrat, horsContrat);

        // Transformer en fichier XML
        TransformerFactory tf = TransformerFactory.newInstance();
        Transformer transformer = tf.newTransformer();
        transformer.setOutputProperty(OutputKeys.INDENT, "yes");
        transformer.setOutputProperty("{http://xml.apache.org/xslt}indent-amount", "2");

        DOMSource source = new DOMSource(doc);
        StreamResult result = new StreamResult(outputFile);

        transformer.transform(source, result);
    }

    /** Ajoute une liste de matériels dans un élément XML */
    private static void ajouterMateriels(Document doc, Element parent, List<Materiel> liste) {
        for (Materiel m : liste) {
            Element elMat = doc.createElement("materiel");
            elMat.setAttribute("numSerie", m.getNumSerie());
            parent.appendChild(elMat);

            // TYPE
            Element elType = doc.createElement("type");
            elType.setAttribute("refInterne", m.getType().getRefInterne());
            elType.setAttribute("libelle", m.getType().getLibelle());
            elMat.appendChild(elType);

            // FAMILLE
            Element elFam = doc.createElement("famille");
            elFam.setAttribute("codeFamille", m.getFamille().getCodeFamille());
            elFam.setAttribute("libelle", m.getFamille().getLibelle());
            elMat.appendChild(elFam);

            // Quantité
            Element qty = doc.createElement("quantite");
            qty.setTextContent(String.valueOf(m.getQuantite()));
            elMat.appendChild(qty);

            // Dates et prix
            elMat.appendChild(creerElement(doc, "date_vente", m.getDateVente().toString()));
            elMat.appendChild(creerElement(doc, "date_installation", m.getDateInstallation().toString()));
            elMat.appendChild(creerElement(doc, "prix_vente", String.valueOf(m.getPrixVente())));
            elMat.appendChild(creerElement(doc, "emplacement", m.getEmplacement()));

            // Si sous contrat → nb jours avant échéance
            if (m.getNbJourAvantEcheance() >= 0) {
                elMat.appendChild(creerElement(doc, "nbJourAvantEcheance",
                        String.valueOf(m.getNbJourAvantEcheance())));
            }
        }
    }

    private static Element creerElement(Document doc, String nom, String texte) {
        Element e = doc.createElement(nom);
        e.setTextContent(texte);
        return e;
    }
}
