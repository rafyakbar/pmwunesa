<div id="lupapass" class="{{ Session::has('tab') && Session::get('tab') == 'reset' ? 'active' : '' }} tab-pane fade in">
    <div class="panel-default login-panel panel">
        <div class="panel-body">
            <form role="form" action="{{ route('reset.password') }}" method="post">

                {{ csrf_field() }}

                <fieldset>
                    <div class="form-group">
                        <label style="color: #111111">Email</label>
                        <input name="form" type="hidden" value="lupapass">
                        <input required="" class="form-control" placeholder="Email" name="email" type="email" value="" autocomplete="on">
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-9 col-lg-3">
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>