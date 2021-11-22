{include file='templates/header.tpl'}

    <div class="row mt-4">
        <div class="col-md-4">
            <h2>{$tituloform}</h2>
            {include file='templates/productDetail.tpl'}
        </div>
        <div>
            {include file='templates/productCommentForm.tpl'}
        </div>
        <div class="col-md-8">
            <!-- hueco  para lista commentes de un producto -->
             <ul class="list-group" id="comments-list">
             
            </ul>
        </div>
    </div>

    <script src="js/app.js"></script>
{include file='templates/footer.tpl'}