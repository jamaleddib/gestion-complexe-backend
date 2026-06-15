<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            color: #333;
        }
        .ticket {
            border: 2px dashed #2c7be5;
            border-radius: 12px;
            padding: 25px;
        }
        h1 {
            color: #2c7be5;
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 8px 0;
            font-size: 14px;
        }
        td.label {
            font-weight: bold;
            width: 40%;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
        .badge {
            display: inline-block;
            padding: 4px 12px;
            background-color: #28a745;
            color: white;
            border-radius: 4px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <h1>Ticket de Réservation</h1>
        <table>
            <tr>
                <td class="label">Numéro de réservation :</td>
                <td>#{{ $reservation->id }}</td>
            </tr>
            <tr>
                <td class="label">Client :</td>
                <td>{{ $reservation->client->name }} {{ $reservation->client->prenom }}</td>
            </tr>
            <tr>
                <td class="label">Email :</td>
                <td>{{ $reservation->client->email }}</td>
            </tr>
            <tr>
                <td class="label">Terrain :</td>
                <td>{{ $reservation->terrain->nom }}</td>
            </tr>
            <tr>
                <td class="label">Type :</td>
                <td>{{ $reservation->terrain->type ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Date</td>
                <td>{{ $reservation->date }}</td>
            </tr>
            <tr>
                <td class="label">Heure début :</td>
                <td>{{ $reservation->heure_debut }}</td>
            </tr>
            <tr>
                <td class="label">Heure fin :</td>
                <td>{{ $reservation->heure_fin }}</td>
            </tr>
            <tr>
                <td class="label">Prix :</td>
                <td>{{ $reservation->terrain->prix }} DH</td>
            </tr>
            <tr>
                <td class="label">Statut paiement :</td>
                <td><span class="badge">Payé</span></td>
            </tr>
        </table>
        <div class="footer">
            Merci d'avoir réservé avec nous ! Présentez ce ticket à l'entrée.
        </div>
    </div>
</body>
</html>
