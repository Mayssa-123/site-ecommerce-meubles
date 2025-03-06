<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture #{{ $order_id }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .invoice {
            max-width: 1000px;
            margin: 40px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            font-size: 28px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .header p {
            font-size: 16px;
            color: #7f8c8d;
        }
        .details {
            margin-top: 40px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ecf0f1;
            font-size: 16px;
            color: #2c3e50;
        }
        th {
            background-color: #ecf0f1;
            color: #34495e;
        }
        .total-row {
            background-color: #ecf0f1;
            font-size: 18px;
            font-weight: 600;
            padding: 15px;
        }
        .total-price {
            color: #e74c3c;
            font-size: 20px;
        }
        .footer {
            text-align: center;
            font-size: 16px;
            color: #7f8c8d;
            margin-top: 40px;
        }
        .btn {
            display: inline-block;
            padding: 12px 25px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            border-radius: 5px;
            margin-top: 30px;
        }
        .btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

<div class="invoice">
    <div class="header">
        <h2>Facture #{{ $order_id }}</h2>
        <p>Utilisateur: {{ $user_name }}</p>
        <p>Date de commande: {{ $created_at }}</p>
    </div>

    <div class="details">
        <h3>Détails de la commande</h3>
        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix Unitaire</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->product->name }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ number_format(($product->product->price - ($product->product->promotion ?? 0)), 2) }} TND</td>
                        <td>{{ number_format(($product->product->price - ($product->product->promotion ?? 0)) * $product->quantity, 2) }} TND</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @php
            function sumTotal($products) {
                return $products->sum(function ($product) {
                    $price_after_discount = $product->product->price - ($product->product->promotion ?? 0);
                    return $price_after_discount * $product->quantity;
                });
            }
        @endphp

        <div class="total-row">
            <p>Total: <span class="total-price">{{ number_format(sumTotal($products), 2) }} $</span></p>
        </div>





        <p><strong>Méthode de Paiement: </strong>{{ $payment_method }}</p>
        <p><strong>Statut: </strong>{{ $status }}</p>
    </div>

    <div class="footer">
        <p>Merci pour votre achat !</p>
        <p>Pour toute question, contactez-nous à support@entreprise.com</p>
    </div>
</div>

</body>
</html>
