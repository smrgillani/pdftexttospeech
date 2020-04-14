

      <tr>
                        

        <td>{{$package->title}}</td>

        <td>{{$package->sku}}</td>

        <td>{{$package->price}}</td>

        <td>
          <div class="d-flex">

              <!--   <a  class="btn themeBtn editPackage"  packageID="{{$package->id}}" data-title="{{$package->title}}" data-description="{{$package->description}}" data-price="{{$package->price}}" data-rebill-price="{{$package->rebill_price}}" data-rebill-commission="{{$package->rebill_commission}}" data-sku="{{$package->sku}}">Edit</a> -->
            <a href='#' class="mr-4 deletebtn" id="deletepackage" packageID="{{$package->id}}"> <img src="assets/img/deleteicon.png" width="" data-toggle="tooltip" title="Delete"></a>
          </div>
        </td>
      </tr>
      <input type="hidden" name="sku-" value="{{$sku}}">