<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>

  </head>
  <body>

    <div class="col-md-12 text-center">
<a href="javascript:onClick=window.print();window.location.reload(true);"><img src="https://www.portakaltercume.net/crm/assets/img/portakaltercume.png" alt="" /></a>
</div>

<div  class="contsainer" style="margin-top:100px;">
<table class="table table-responsive">
    <caption><h4>Portakal Tercüme - Müşteri Takip Formu</h4></caption>

<tbody>


        <tr>
                <td>Teklif Tarihi</td>
                <td>{{ $onay->TeklifVerilenTarih }}</td>
        </tr>
        <tr>
                <td>Ad Soyad</td>
                <td>{{ $onay->isimSoyisim }}</td>
        </tr>
        <tr>
                <td>Telefon</td>
                <td>{{ $onay->Telefon }}</td>
        </tr>
        <tr>
                <td>E-Posta</td>
                <td>{{ $onay->Email }}</td>
        </tr>
        <tr>
                <td>Kaynak Dil</td>
                <td>{{ $onay->KaynakDil }}</td>
        </tr>
        <tr>
                <td>Hedef Dil</td>
                <td>{{ $onay->HedefDil }}</td>
        </tr>
        <tr>
                <td>Fiyat</td>
                <td>{{ $onay->Fiyat }} TL</td>
        </tr>
        <tr>
                <td>Kapora</td>
                <td>{{ $onay->Kapora }} TL</td>
        </tr>


</tbody>
</table>
</div>







<link rel="javascript" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
  </body>
</html>
