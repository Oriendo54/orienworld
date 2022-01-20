<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Pony On Fire - Facture N°{{ $facture->id_facture }}</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        
        <style>
            @page {
                margin: 0cm 0cm;
            }

            /** Define now the real margins of every page in the PDF **/
            body {
                margin-top: 2cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2cm;
            }

            /** Define the header rules **/
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2cm;

                /** Extra personal styles **/
                text-align: center;
                line-height: 1.5cm;
            }

            /** Define the footer rules **/
            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 0cm; 
                right: 0cm;
                height: 3cm;

                /** Extra personal styles **/
                font-size: 0.9em;
                text-align: center;
            }
        </style>
  
    </head>

    <body>
        
        <header>
            <p>Ecurie MAYER<p>
        </header>

        <footer>
            <p>
                <br>
                Ecurie MAYER SARL 55 rue de Rohrbach 57415 ENCHENBERG
                <br>
                Capital 2000€ - 488 745 522 - RCS SARREGUEMINES
                <br>
                06 80 92 12 10 - ecurie.gm@gmail.com
            <p>
        </footer>
        
        <main role="main" class="container-fluid">
            
            <div class="row">
                <div class="col">
                    <!--<img src="https://www.selleriedesnacres.fr/img/sellerie-des-nacres-logo-1585129093.jpg" alt="Sellerie des Nacres"/>-->
                </div>
                <div class="col text-right">
                    <br>
                    Facture N°{{ $facture->id_facture }}
                    <br>{{ date('d/m/Y', strtotime($facture->updated_at)) }}
                </div>
            </div> 
            
            <div class="row">
                <div class="col">
                    
                    {{ $facture->pofclient->nom }} {{ $facture->pofclient->prenom }}
                    
                    @if($facture->pofclient->pofclientadressedefaut)
                    <br>
                    {{ $facture->pofclient->pofclientadressedefaut->rue }}
                    
                    <br>
                    {{ $facture->pofclient->pofclientadressedefaut->code_postal }}
                    {{ $facture->pofclient->pofclientadressedefaut->ville }}
                    @endif
                    
                </div>
            </div>
            
            @if(isset($facture->poffacturedetails))
            
            <div class="row" style="font-size:0.8em">
                <div class="col">
                    
                    <br>
                    
                    <table class="table table-striped table-hover table-bordered">
                        <thead id="facture-header">
                            
                            <tr>
                                <th>Prestation</th>
                                <th>Quantité</th>
                                <th>Total TTC</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                            
                            @php $total_ht = 0;$total_ttc = 0; @endphp
                            
                            @foreach ($facture->poffacturedetails as $facturedetail)
                                <tr>
                                    <td>
                                        @if($facturedetail->libelle)
                                            {{ $facturedetail->libelle }}
                                        @else 
                                            {{ $facturedetail->pofprestation->libelle }}
                                        @endif
                                    </td>
                                    <td>{{ $facturedetail->quantite }}</td>
                                    <td>{{ round($facturedetail->total_ttc,2) }} €</td>
                                </tr>
                                
                                @php $total_ht += $facturedetail->total_ht;$total_ttc += $facturedetail->total_ttc; @endphp
                            
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
                    
            <div class="row" style="font-size:0.8em">
                <div class="col-6">
                    
                    <table class="table table-striped table-hover table-bordered">
                        <tbody>
                             
                            @php $total_total_tva = 0; @endphp
                                
                            @foreach($tvas as $tva)
                    
                                @php $total_tva = 0; @endphp

                                @foreach ($facture->poffacturedetails as $facturedetail)

                                    @if($facturedetail->pofprestation->id_tva == $tva->id_tva)

                                    @php $total_tva += round($facturedetail->total_ttc, 2) - round($facturedetail->total_ht, 2); @endphp

                                    @endif

                                @endforeach

                                @if($total_tva>0)
                                
                                @php $total_total_tva += $total_tva; @endphp
                                
                                <tr>
                                    <td>TVA {{ round($tva->taux,2) }} %</td>
                                    <td>{{ round($total_tva,2) }} €</td>
                                </tr>

                                @endif

                            @endforeach
                                
                            <tr>
                                <th>Total TVA</th>
                                <td>{{ round($total_total_tva,2) }} €</td>
                            </tr>
                            
<!--                            <tr>
                                <td><b>Total HT</b></td>
                                <td>{{ round($total_ht,2) }} €</td>
                            </tr>-->
                            
                            <tr>
                                <td><b>Total TTC à régler</b></td>
                                <td><b>{{ round($total_ttc,2) }} €</b></td>
                            </tr>
                            
                        </tbody>
                    </table>
                    
                </div>
            </div>
            
            @endif
                    
        </main>
        
    </body>
</html>