{include file="templates/header.tpl"}

<div class="container">

    <div >
        <h3 class=" display-3">{$titleProduct}</h3>

        <div class="card-body"  enctype="multipart/form-data">
            {if $product->image }
            <img src="{$product->image}" class="img-fluid" alt="...">       
            {/if}
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
        
        </table> 

        {if $isLoggedIn}
        <form method="POST"  action=""  class="my-4" id="create-comment-form" >
            <div class="row">
                <div class="col-9">
                    <div class="form-group">
                        <label>Comentario</label>
                        <textarea name="comment" class="form-control" rows="3"></textarea>
                    </div>
                </div>
        
                <div class="col-3">
                    <div class="form-group">
                        <label>Prioridad</label>
                        <select name="score" class="form-control">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </div>
            </div>
            <input type="hidden" value ="{$product->id}" name="product_id">
            <button type="submit" class="btn btn-primary mt-2" id="btn-create-comment" >
             Guardar comentario</button>
        </form>      
        {else}<p>Para comentar debes <a href="{BASE_URL}/login">iniciar sesión</a></p>
        {/if}
        <div >
            <h3 > Comentarios</h3>
             <ul class="list-group" id="comments" data-product-id="{$product->id}" data-delete-enabled="{if $isAdmin }1{else}0{/if}">
            </ul>
        </div>
    </div>
</div>
<script src="tiendaMia/js/comments.js"></script>
{include file="templates/footer.tpl" assign=name var1=value}