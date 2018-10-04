_this = {
  panelId: '#panel',
  panelNav: '#panelNav',
  panelHide: 'panelHide',
  panelLeftArrow: 'fa-angle-double-left',
  panelRightArrow: 'fa-angle-double-right',
  mediaElements:['#record','#stop','#play'],
  visualizationElements:['#analyser','#wavedisplay'],
  mediaRecordElem: document.getElementById('record')
}

/**
 * Show hide panel based on user interaction
 * 
 */
function togglePanel() {
  $id = $(_this.panelId);
  $this = $(_this.panelNav);

  // Going to open
  if ($id.hasClass(_this.panelHide)) {

    $id.removeClass(_this.panelHide);
    $this.removeClass(_this.panelLeftArrow);
    $this.addClass(_this.panelRightArrow);
  }
  // Going to close
  else {
    $id.addClass(_this.panelHide);
    $this.addClass(_this.panelLeftArrow);
    $this.removeClass(_this.panelRightArrow);
  }
  _via_update_ui_components();
}

/**
 * Clear text editor content
 * 
 * @param {id} id element id of text editor
 */
function clearTextEditor(id){
  $(id).val('');
}

/**
 * Start voice recording
 */
function record(){
  toggleVisualization('#analyser');
  toggleRecording(_this.mediaRecordElem);
  togglePage('#stop');
}

/**
 * Stop voice recording
 */
function stop(){
  togglePage('#play');
  toggleVisualization('#wavedisplay');
  toggleRecording(_this.mediaRecordElem);
}

/**
 * Play recorded voice
 */
function play(){
  togglePage('#record');
  toggleVisualization();
}

/**
 * Function can be used to show element
 * section
 * 
 * @param {string} id element id
 */
function togglePage(id){
  let elems = _this.mediaElements.slice();
  let index = elems.indexOf(id);
  if(index >= 0){
    elems.splice(index,1);
  }

  $(elems.join(',')).hide();
  $(id).show();
}

function toggleVisualization(id){
  let elems = _this.visualizationElements.slice();
  let index = elems.indexOf(id);
  if(index >= 0){
    elems.splice(index,1);
  }

  $(elems.join(',')).hide();
  $(id).show();
}