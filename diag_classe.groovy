
classDiagram
    class Produit { 
      -String codeBarres
      -String libelle
      -double prixTtc
      +Produit(codeBarres, libelle, prixTtc)
      +getCodeBarres() String
      +getLibelle() String
      +setLibelle(libelle) void
      +getPrixTtc() double
      +setPrixTtc(prixTtc) void
    }

    class LigneCommande {
      -Produit produit
      -int quantite
      +LigneCommande(produit, quantite)
      +getProduit() Produit
      +getQuantite() int
      +setQuantite(q) void
      +getTotalTtc() double
    }

    class Panier {
      -Map~String, LigneCommande~ lignesParCode
      +ajouterProduit(produit, q) void
      +supprimerLigne(codeBarres) void
      +getTotalTtc() double
      +getLignes() List~LigneCommande~
      +vider() void
    }

    class ProduitRepository {
      <<interface>>
      +findByCodeBarres(codeBarres) Optional~Produit~
    }

    class SQLiteProduitRepository {
      -String jdbcUrl
      +SQLiteProduitRepository(jdbcUrl)
      +findByCodeBarres(codeBarres) Optional~Produit~
    }

    class PaymentService {
      <<interface>>
      +payer(panier, montant) String
    }

    class CardPaymentService {
      +payer(panier, montant) String
    }
