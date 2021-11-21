{include file="templates/header.tpl" }

<div class="row"> 

        <div class="col-6" >   
            <div class="card-body">
                <h2 class=" display-3">  {$titleProduct}</h2>
                <h5 class="display-6">{$product->category|capitalize}</h5>
            </div> 
            <div class="card-body"  enctype="multipart/form-data">
                <img src="{$product->imagen}" class="img-fluid" alt="...">
                    
            </div> 
            <div class="card-body">   
                <ul class="list-group list-group-flush">
                    <li class="list-group-item h4"> {$product->name|capitalize}</li>
                    <li class="list-group-item h6">Precio: {$product->price|floatval}</li>
                    <li class="list-group-item h6">Talle: {$product->size|upper}</li>
                    <li class="list-group-item h6">Ver medios de pago</li>
                </ul>
            </div>
            <div>
                <a class="btn btn-success" href="{BASE_URL}/commentProduct/{$product->id}">comentar</a>    
            </div>
        </div>
        <div class="col-6">
       
        </div>       
</div>
<div class="row"> 
    <div class="col-md-8">
                <!-- hueco para API-->
                <ul class="list-group" id="comments-list"> </ul>
    </div>
</div>


<script src="js/api.js"></script>
{include file="templates/footer.tpl" assign=name var1=value}
