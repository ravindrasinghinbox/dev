_this = {
  panelId: '#panel',
  panelNav: '#panelNav',
  panelHide: 'panelHide',
  panelLeftArrow: 'fa-angle-double-left',
  panelRightArrow: 'fa-angle-double-right'
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

(function () {
  $('.rightContainer a.nav-link').click(function () {
    if ($(this).closest('.' + _this.panelHide).length) {
      togglePanel();
    }
  });
})();