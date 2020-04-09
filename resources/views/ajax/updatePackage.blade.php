<td>{{$package->title}}</td>

                            <td>{{$package->sku}}</td>

                            <td>{{$package->price}}</td>

                            <td>
                              <div class="d-flex">

                                    <a   class="mr-4 editbtn"  packageID="{{$package->id}}" data-package-id="{{$package->id}}" data-title="{{$package->title}}" data-description="{{$package->description}}" data-price="{{$package->price}}" data-rebill-price="{{$package->rebill_price}}" data-rebill-commission="{{$package->rebill_commission}}" data-sku="{{$package->sku}}"><img src="assets/img/edit.png" width="" data-toggle="tooltip" title="Edit"></a>
                              

                              <a href='#' class="mr-4 deletebtn" id="deletepackage" packageID="{{$package->id}}"> 
                                <img src="assets/img/deleteicon.png" width="" data-toggle="tooltip" title="Delete">
                              </a>


                              </div>
                            </td>