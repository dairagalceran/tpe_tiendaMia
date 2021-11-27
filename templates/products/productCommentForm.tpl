<div id="app">

    <h1>{$titulo}<h1>

            <form id="formAddComment" submit="addComment" method="POST">
                <div class="col-8">
                    <div class="form-group">
                        <label> Comentario</label>
                        <input name="comment" type="text" class="form-control">
                    </div>

                    <div class="table mt-5 col-md-5">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Valoración</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        <select name="score" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </th>
                                    <th>
                                        <a class="btn btn-success"
                                            href="{BASE_URL}/commentProduct/{$product->id}">Agregar comentario</a>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
            </form>

</div>