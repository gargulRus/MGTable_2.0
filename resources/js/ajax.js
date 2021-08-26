var loadGif = "<img src=\"/resources/images/load.gif\" alt=\"this slowpoke moves\"  width=\"50\" />";

function funcBeforeBase () {
    $("#base-edit").html(loadGif);
}

function funcSuccessBase (data) {
    $("#base-edit").html(data);
}

function funcBeforeChangesWorkers () {
    $("#contentChanges").html(loadGif);
}
function funcSuccessChangesWorkers (data) {
    $("#contentChanges").html(data);
}

function funcBeforeListObject() {
    $("#list-objects-content").html(loadGif);
}

function funcSuccessListObject(data) {
    $("#list-objects-content").html(data);
}

function funcBeforeBase () {
    $("#base-edit").html(loadGif);
}

function funcSuccessBase (data) {
    $("#base-edit").html(data);
}

function funcBeforeChangesActivity () {
    $("#changesloadactivity").html(loadGif);
}

function funcSuccessChangesActivity (data) {
    $("#changesloadactivity").html(data);
}

function funcBeforeChanges () {
    $("#objectChanges").html(loadGif);
}

function funcSuccessChanges (data) {
    $("#objectChanges").html(data);
}

function funcBeforeObjectDetails() {
    $("#objects-content-tab").html(loadGif);
}

function funcSuccessObjectDetails(data) {
    $("#objects-content-tab").html(data);
}

function funcBeforeObjectId() {
    $("#objecthere").html(loadGif);
}
function funcSuccessObjectId(data) {
    $("#objecthere").html(data);
}