{include file="templates/header.tpl"}


<div class="container">

    <div >
        <h3 class=" display-3">{$titleProduct}</h3>

        <div class="card-body"  enctype="multipart/form-data">
            <img src="{$product->imagen}" class="img-fluid" alt="...">       
        </div> 
        
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Categoria</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Talle</th>
                    <th scope="col">Precio</th>
                </tr>
            </thead>
            <tbody>           
                <tr>
                    <td scope="row"><a class= "list-group-item" href="{BASE_URL}/productsCategory/{$product->category_id}">{$product->category|upper}</a></th>
                    <td>{$product->name|capitalize}</td>
                    <td>{$product->size|capitalize}</td>
                    <td>{$product->price|floatval}</td>
                </tr> 
            </tbody>
            <tfoot>
                <td><a class="btn btn-success" href="{BASE_URL}/commentProduct/{$product->id}">Comentar</a> </td>                <a class="btn btn-success" href="{BASE_URL}/commentProduct/{$product->id}">comentar</a>    
            </tfoot>
        </table> 
      
    </div>
</div>

{include file="templates/footer.tpl" assign=name var1=value}




