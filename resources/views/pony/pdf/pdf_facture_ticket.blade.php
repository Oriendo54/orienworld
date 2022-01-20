<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pony On Fire</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- CSS -->
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
    <style>
            @page {
                margin: 0cm;
                font-size: 0.5rem;
            }

            body {
                margin: 0.3cm;
            }

            .pdf_page_break {
                page-break-after: always;
            }

            header {
                position: fixed;
                top: 1cm;
                left: 2cm;
                right: 0cm;
                height: 1cm;

                /** Extra personal styles **/
                text-align: center;
                line-height: 1.5cm;
            }

            footer {
                position: fixed;
                bottom: 0.2cm;
                left: 0.5cm;
                height: 0.5cm;
            }
    </style>
</head>


<body>
    <section id="client_ticket" class="mb-4 pdf_page_break">
        <header>
            <h4>Ecurie Guillaume Mayer</h4>
        </header>

        <p class="mb-4">Exemplaire client</p>
        <p class="font-weight-bold mb-4">Facture n°{{$facture->id_facture}}<br/>
        {{ $facture->pofclient->nom }} {{ $facture->pofclient->prenom }}</p>

        @if(isset($facture->poffacturedetails))
        <table class="table table-sm mb-4">
            @foreach($facture->poffacturedetails as $facturedetail)
                <tr>
                    @if($facturedetail->libelle)
                    <td>{{ $facturedetail->libelle }}</td>
                    @else
                    <td>{{ $facturedetail->pofprestation->libelle }}</td>
                    @endif
                    <td>{{ round($facturedetail->total_ttc, 2) }} € <sup>({{$facturedetail->pofprestation->id_tva}})</sup></td>
                    <td>(x{{ $facturedetail->quantite }})</td>
                </tr>
            @endforeach
        </table>
        @endif

        <div>
            <p>{{ round($facture->total_ht, 2) }}€ HT<br/>
            <span class="font-weight-bold">TOTAL {{ round($facture->total_ttc, 2) }}€ TTC</span></p>

            @if($facture->poffacturebonachats)
            <div>
                <p>Bons d'achats déduis : {{ round(POFFacture::factureBonachatsUtilises($facture->id_facture), 2) }} €<br/>
                <span class="font-weight-bold">Total réglé : {{round($facture->total_bonachat_deduis, 2)}} €</span></p>
            </div>
            @endif

            <p>
            @foreach($facture->poffacturemoyenspaiement as $mode_paiement)
                @if($mode_paiement->montant != 0)
                {{ $mode_paiement->pofmoyenpaiement->libelle }} : {{ round($mode_paiement->montant, 2) }}€ <br/>
                @endif
            @endforeach
            </p>
        </div>

        <div>
            <p><span class="font-weight-bold">TVA</span><br/>
            @foreach($tvas as $tva)
            ({{$tva->id_tva}}) : {{ round($tva->taux, 2) }}%<br/>
            @endforeach
            </p>
        </div>

        <footer>
            <p>{{ \Carbon\Carbon::now()->format('d-m-Y H:i:s') }}</p>
        </footer>
    </section>
    
    <section id="sellerie_ticket">
        <header>
            <h4>Ecurie Guillaume Mayer</h4>
        </header>

        <p class="mb-4">Exemplaire commerçant</p>
        <p class="font-weight-bold mb-4">Facture n°{{$facture->id_facture}}<br/>
        {{ $facture->pofclient->nom }} {{ $facture->pofclient->prenom }}</p>

        @if(isset($facture->poffacturedetails))
        <table class="table table-sm mb-4">
            @foreach($facture->poffacturedetails as $facturedetail)
                <tr>
                    @if($facturedetail->libelle)
                    <td>{{ $facturedetail->libelle }}</td>
                    @else
                    <td>{{ $facturedetail->pofprestation->libelle }}</td>
                    @endif
                    <td>{{ round($facturedetail->total_ttc, 2) }} € <sup>({{$facturedetail->pofprestation->id_tva}})</sup></td>
                    <td>(x{{ $facturedetail->quantite }})</td>
                </tr>
            @endforeach
        </table>
        @endif

        <div>
            <p>{{ round($facture->total_ht, 2) }}€ HT<br/>
            <span class="font-weight-bold">TOTAL {{ round($facture->total_ttc, 2) }}€ TTC</span></p>

            @if($facture->poffacturebonachats)
            <div>
                <p>Bons d'achats déduis : {{ round(POFFacture::factureBonachatsUtilises($facture->id_facture), 2) }} €<br/>
                <span class="font-weight-bold">Total réglé : {{round($facture->total_bonachat_deduis, 2)}} €</span></p>
            </div>
            @endif

            <p>
            @foreach($facture->poffacturemoyenspaiement as $mode_paiement)
                @if($mode_paiement->montant != 0)
                {{ $mode_paiement->pofmoyenpaiement->libelle }} : {{ round($mode_paiement->montant, 2) }}€ <br/>
                @endif
            @endforeach
            </p>
        </div>

        <div>
            <p><span class="font-weight-bold">TVA</span><br/>
            @foreach($tvas as $tva)
            ({{$tva->id_tva}}) : {{ round($tva->taux, 2) }}%<br/>
            @endforeach
            </p>
        </div>

        <footer>
            <p>{{ \Carbon\Carbon::now()->format('d-m-Y H:i:s') }}</p>
        </footer>
    </section>
</body>
</html>