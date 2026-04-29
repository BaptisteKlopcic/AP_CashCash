
import org.apache.pdfbox.pdmodel.PDDocument;
import org.apache.pdfbox.pdmodel.PDPage;
import org.apache.pdfbox.pdmodel.PDPageContentStream;
import org.apache.pdfbox.pdmodel.font.PDType1Font;

import java.io.File;
import java.io.IOException;
import java.time.LocalDate;
import java.time.format.DateTimeFormatter;

/**
 * Classe utilitaire permettant de générer des courriers PDF
 * pour les relances de contrats de maintenance.
 */
public class PdfRelanceGenerator {

    /**
     * Génère un PDF individuel pour un client.
     *
     * @param idClient identifiant du client
     * @param nomClient nom du client
     * @param dateEcheance date d'échéance du contrat
     * @param joursRestants nombre de jours avant expiration
     * @param fichierSortie fichier PDF à générer
     * @throws IOException en cas d'erreur d'écriture du PDF
     */
    public static void genererPdfClient(String idClient,
                                        String nomClient,
                                        LocalDate dateEcheance,
                                        long joursRestants,
                                        File fichierSortie) throws IOException {

        // Création du document PDF
        PDDocument document = new PDDocument();
        PDPage page = new PDPage();
        document.addPage(page);

        // Pour écrire du texte dans le PDF
        PDPageContentStream content = new PDPageContentStream(document, page);

        // Marges et position
        final int marginLeft = 80;
        int y = 700;

        content.beginText();
        content.setFont(PDType1Font.HELVETICA_BOLD, 18);
        content.newLineAtOffset(marginLeft, y);
        content.showText("Relance de contrat de maintenance");
        content.endText();

        y -= 40;

        // Informations du client
        content.beginText();
        content.setFont(PDType1Font.HELVETICA, 12);
        content.newLineAtOffset(marginLeft, y);
        content.showText("Client : " + nomClient + " (ID : " + idClient + ")");
        content.endText();

        y -= 20;

        content.beginText();
        content.newLineAtOffset(marginLeft, y);
        content.showText("Date d'échéance du contrat : " +
                dateEcheance.format(DateTimeFormatter.ofPattern("dd/MM/yyyy")));
        content.endText();

        y -= 20;

        content.beginText();
        content.newLineAtOffset(marginLeft, y);
        content.showText("Jours restants avant expiration : " + joursRestants + " jours");
        content.endText();


        // Corps du courrier
        y -= 60;
        ajouterParagraphe(content, marginLeft, y,
                "Madame, Monsieur,"
        );

        y -= 20;
        ajouterParagraphe(content, marginLeft, y,
                "Nous vous informons que votre contrat de maintenance arrive bientôt à expiration."
        );

        y -= 20;
        ajouterParagraphe(content, marginLeft, y,
                "Afin d'assurer la continuité du service ainsi que le bon fonctionnement "
                        + "de vos équipements, nous vous invitons à procéder au renouvellement "
                        + "de votre contrat dans les plus brefs délais."
        );

        y -= 20;
        ajouterParagraphe(content, marginLeft, y,
                "Pour toute information complémentaire, nos équipes restent à votre disposition."
        );

        y -= 40;
        ajouterParagraphe(content, marginLeft, y,
                "Cordialement,"
        );

        y -= 20;
        ajouterParagraphe(content, marginLeft, y,
                "Le service clientèle CASHCASH."
        );

        // Fin du flux d'écriture
        content.close();

        // Sauvegarde du PDF
        document.save(fichierSortie);
        document.close();
    }


    /**
     * Permet d'ajouter facilement un paragraphe dans un PDF.
     */
    private static void ajouterParagraphe(PDPageContentStream content,
                                          int x, int y, String texte) throws IOException {
        content.beginText();
        content.newLineAtOffset(x, y);
        content.setFont(PDType1Font.HELVETICA, 12);
        content.showText(texte);
        content.endText();
    }
}
