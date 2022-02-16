<div id="divExIm_{$sys.req.rid}" class="" style="display:none;">
    <div class="portlet-body form">
        <form class="uForm" enctype="multipart/form-data" method="post" action="{$sys.cfg.url}cp/upload/{$sys.rsp.upl|default:0}/{$sys.req.rid}">
            <div class="note note-danger">
                <p> 1. Verifikasi ulang antara data asal dan data terunggah<br />
                    2. Pastikan jumlah baris sama<br />
                    3. Pastikan akumulasi nilai sama<br />
                    4. Perhatikan data dengan warna merah, verifikasi apakah sesuai dengan data asal
                </p>
            </div>
            <div class="row fileupload-buttonbar">
                <div class="col-lg-7">
												<span class="btn green fileinput-button"> <i class="fa fa-plus"></i>
													<span> Add files... </span>
													<input type="file" multiple="" name="files[]">
												</span>
                    <button class="btn blue start" type="submit"><i class="fa fa-upload"></i> <span> Start upload </span></button>
                    <button class="btn warning cancel" type="reset"><i class="fa fa-ban-circle"></i> <span> Cancel upload </span></button>
                    <button class="btn red delete" type="button"><i class="fa fa-trash"></i><span> Delete </span></button>
                    <input type="checkbox" class="toggle" />
                    <span class="fileupload-process"> </span>
                </div>
                <div class="col-lg-5 fileupload-progress fade">
                    <div aria-valuemax="100" aria-valuemin="0" role="progressbar" class="progress progress-striped active">
                        <div style="width:0%;" class="progress-bar progress-bar-success"></div>
                    </div>
                    <div class="progress-extended"></div>
                </div>
            </div>
        </form>
    </div>
</div>