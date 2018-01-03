<aside id="linimasa">
    <div class="card">
        <div class="card-header" data-background-color="green">
            <h4>Lini masa</h4>
        </div>
        <div class="card-content"></div>
    </div>
    
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                    <div class="alert alert-success">
                        {{ \Carbon\Carbon::parse(\PMW\Models\Pengaturan::batasUnggahProposal())->formatLocalized('%A, %d %B %Y') }}
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">
                    <div class="alert">
                        Batas Pengumpulan Proposal<br/>
                        <b>Oleh mahasiswa</b>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                    <div class="alert alert-success">
                        {{ \Carbon\Carbon::parse(\PMW\Models\Pengaturan::batasPenilaian(1))->formatLocalized('%A, %d %B %Y') }}
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">
                    <div class="alert">
                        Batas Penilaian Proposal Tahap Pertama<br/>
                        <b>Oleh reviewer</b>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                    <div class="alert alert-success">
                        {{ \Carbon\Carbon::parse(\PMW\Models\Pengaturan::batasPenilaian(2))->formatLocalized('%A, %d %B %Y') }}
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">
                    <div class="alert">
                        Batas Penilaian Proposal Tahap Kedua<br/>
                        <b>Oleh reviewer</b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>