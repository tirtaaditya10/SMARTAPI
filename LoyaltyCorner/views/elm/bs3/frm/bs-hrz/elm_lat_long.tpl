<div class="form-group">
    <label for="latitude" class="control-label col-md-3">Coordinates </label>
    <div class="col-md-3">
        <div class="input-group input-icon right">
            <span class="input-group-addon">Lat.</span>
            <input type="number" id="latitude" name="latitude" class="form-control numeric text-right" value="{$sys.rsp.dat.latitude|default:''}"/>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group input-icon right">
            <span class="input-group-addon">Long.</span>
            <input type="number" id="longitude" name="longitude" class="form-control numeric text-right" value="{$sys.rsp.dat.longitude|default:''}"/>
        </div>
    </div>
    <a id="drawMap" class="btn btn-default">View on Maps</a>
</div>
<div id="gMap"></div>