<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Fiche de Paie</title>
    <style>
        @page {
            margin: 30px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #2c3e50;
            margin: 0;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }

        .header-left {
            flex: 1.5;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header-center {
            flex: 1;
            text-align: center;
            padding: 8px;
            border: 1px solid #2980b9;
            border-radius: 8px;
            background-color: #ecf0f1;
            margin: 0 10px;
            box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        }

        .header-center h1 {
            font-size: 16px;
            color: #014b7c;
            margin: 0;
        }

        .header-center p {
            margin: 2px 0;
            font-size: 13px;
            color: #7f8c8d;
        }

        .header-right {
            flex: 1;
            text-align: right;
        }

        .logo {
            height: 60px;
            width: auto;
        }

        .title-group h1 {
            font-size: 18px;
            color: #2980b9;
            margin: 0;
        }

        .title-group p {
            margin: 2px 0;
            font-size: 13px;
            color: #7f8c8d;
        }

        .bulletin {
            font-size: 13px;
            margin-top: 5px;
            text-align: center;
        }

        .bulletin span {
            background-color: #ecf0f1;
            padding: 3px 8px;
            border-radius: 5px;
            color: #2980b9;
            font-weight: bold;
        }

        .section-title {
            font-weight: bold;
            margin: 20px 0 10px;
            font-size: 14px;
            color: #34495e;
            border-bottom: 1px dashed #ccc;
            text-align: center;
        }

        .info {
            display: flex;
            justify-content: space-between;
        }

        /* .bloc-gauche,
        .bloc-droite {
            width: 48%;
        } */

        /* .bloc-gauche {
            text-align: left;
        }

        .bloc-droite {
            text-align: right;
        } */


        /* .info .item,
        .info .item-name {
            width: 49%;
            margin-bottom: 6px;
        } */

        .info .item {
            width: 50%;
            padding: 3px 0;
            line-height: 1.4;
            text-align: left;
        }

        /* .info .item-name {
            text-align: right;
        } */

        .label {
            font-weight: bold;
            color: #2c3e50;
        }

        .salaire-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .salaire-table th,
        .salaire-table td {
            border: 1px solid #ccc;
            padding: 6px;
            text-align: left;
        }

        .salaire-table th {
            background-color: #ecf0f1;
        }

        .salaire-table .total {
            font-weight: bold;
            color: #27ae60;
        }

        .signature {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }

        .signature-block {
            width: 45%;
            text-align: center;
        }

        .signature-line {
            border-top: 1px solid #000;
            width: 80%;
            margin: 40px auto 0;
        }

        .footer {
            font-size: 10px;
            color: #7f8c8d;
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="header-left">
            <img src="{{ public_path('logoChezjeanne.png') }}" alt="Logo" class="logo">
            <div class="title-group">
                <h1>BULLETIN DE PAIE</h1>
                <p>A conserver sans limitation de durée</p>
                <p>Fiche de paie - {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</p>
            </div>
        </div>

        <div class="header-center">
            <h1>RESTAURANT CHEZ JEANNE</h1>
            <p>07 49 88 95 18</p>
            <p>Le bon goût d’ici, servi avec amour.</p>
            <p class="bulletin">
                N° de bulletin : <span>00{{ $numero }}</span>
            </p>
        </div>


    </div>

    <div class="section-title">Informations Employé</div>
    <div class="info">
        <div class="bloc-gauche">
            <div class="item"><span class="label">Matricule :</span> {{ $employe->matricule }}</div>
            <div class="item"><span class="label">Nom & Prénom :</span> {{ $employe->nom . ' ' . $employe->prenoms }}
            </div>

            <div class="item"><span class="label">Sexe :</span> {{ $employe->sexe }}</div>
            <div class="item"><span class="label">Poste :</span> {{ $employe->poste->titre ?? 'Non renseigné' }}
            </div>

            <div class="item"><span class="label">Département :</span>
                {{ $employe->departement->nom ?? 'Non renseigné' }}</div>
            <div class="item"><span class="label">Téléphone :</span> {{ $employe->telephone ?? 'Non renseigné' }}
            </div>

        </div>
        <div class="bloc-droite">

            <div class="item"><span class="label">Adresse :</span> {{ $employe->adresse ?? 'Non renseigné' }}</div>
            <div class="item"><span class="label">Nationalité :</span>
                {{ $employe->nationalite ?? 'Non renseignée' }}
            </div>

            <div class="item"><span class="label">Date Embauche :</span>
                {{ $employe->date_embauche ?? 'Non renseignée' }}</div>
            <div class="item"><span class="label">Compte Bancaire :</span>
                {{ $employe->numero_compte ?? 'Non renseigné' }}</div>

            <div class="item"><span class="label">Date Paiement :</span>
                {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
        </div>
    </div>


    <div class="section-title">Détail Salaire</div>
    <table class="salaire-table">
        <thead>
            <tr>
                <th>Description</th>
                <th>Montant (FCFA)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Primes</td>
                <td>{{ number_format($employe->primes, 0, ',', ' ') ?? 0 }}</td>
            </tr>
            <tr>
                <td>Congés Payés</td>
                <td>{{ number_format($employe->conges_payes, 0, ',', ' ') ?? 0 }}</td>
            </tr>
            <tr>
                <td>Retenue CNPS</td>
                <td>{{ number_format($employe->retenue_cnps, 0, ',', ' ') ?? 0 }}</td>
            </tr>
            <tr class="total">
                <td>Net à Payer</td>
                <td>{{ number_format($employe->montant, 0, ',', ' ') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="signature">
        <div class="signature-block">
            <p>Signature de l'employé</p>
            <div class="signature-line"></div>
        </div>
        <div class="signature-block">
            <p>Signature du Responsable</p>
            <div class="signature-line"></div>
        </div>
    </div>

    <div class="footer">
        Généré le {{ now()->translatedFormat('d/m/Y à H:i') }}
    </div>

</body>

</html>
