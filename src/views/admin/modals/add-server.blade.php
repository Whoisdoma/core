<div class="modal fade" id="addServerModal" tabindex="-1" role="dialog" aria-labelledby="addServerLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="addServerLabel">Add Server</h4>
            </div>
            <form method="post" id="addserver-form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tld">TLD</label>
                        <input type="text" class="form-control" id="tld" name="tld"  placeholder="TLD"/>
                    </div>
                    <div class="form-group">
                        <label for="server">Server</label>
                        <input type="text" class="form-control" id="server" name="server" placeholder="Server"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-primary" id="addServerBtn" value="Add Server"/>
                </div>
            </form>
        </div>
    </div>
</div>