

{include file="templates/header.tpl"}
            
                <form action="" id="create-comment-form" method="POST" class="my-4">
                    <h1 class= "mt-2">{$tituloform}<h1>
                    <h2 class= "mt-2">Comentario</h2>
                    <div>
                        <select class="form-select" name="score">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div>   
                        <label for="comment">Comentario</label>
                        <input name="comment" type="text" class="form-control" required>
                    </div>
                    <input name="id_product" type="hidden" value="{$product->id}">
                    <input name="id_user" type="hidden" value="{$smarty.session.USER_ID}">
                    <button type="submit" class="btn btn-primary mt-2">Guardar</button>
                </form>
         
<script src="js/api.js"></script>
{include file="templates/footer.tpl" assign=name var1=value}
