//Submitting animation
$(document).ready(function() {
  $('.btn-submit').on('click', function() {
    var $this = $(this);
    var loadingText = '<span class="small"><i class="fa fa-spinner fa-spin fa-fw"></i> Submitting...</span>';
    if ($(this).html() !== loadingText) {
      $this.data('original-text', $(this).html());
      $this.html(loadingText);
    }
    setTimeout(function() {
      $this.html($this.data('original-text'));
    }, 5000);
  });
})

//Resettting animation
$(document).ready(function() {
  $('.btn-reset').on('click', function() {
    var $this = $(this);
    var loadingText = '<span class="small"><i class="fa fa-undo fa-spin fa-bw"></i> Resetting...</span>';
    if ($(this).html() !== loadingText) {
      $this.data('original-text', $(this).html());
      $this.html(loadingText);
    }
    setTimeout(function() {
      $this.html($this.data('original-text'));
    }, 500);
  });
})

//Previewing animation
$(document).ready(function() {
  $('.btn-preview').on('click', function() {
    var $this = $(this);
    var loadingText = '<span class="small"><i class="fa fa-spinner fa-spin fa-bw"></i> Previewing...</span>';
    if ($(this).html() !== loadingText) {
      $this.data('original-text', $(this).html());
      $this.html(loadingText);
    }
    setTimeout(function() {
      $this.html($this.data('original-text'));
    }, 5000);
  });
})

//Updating animation
$(document).ready(function() {
  $('.btn-update').on('click', function() {
    var $this = $(this);
    var loadingText = '<span class="small"><i class="fa fa-refresh fa-spin fa-fw"></i> Updating...</span>';
    if ($(this).html() !== loadingText) {
      $this.data('original-text', $(this).html());
      $this.html(loadingText);
    }
    setTimeout(function() {
      $this.html($this.data('original-text'));
    }, 10000);
  });
})

//Uploading animation
$(document).ready(function() {
  $('.btn-upload').on('click', function() {
    var $this = $(this);
    var loadingText = '<span class="small"><i class="fa fa-spinner fa-spin fa-fw"></i> Uploading...</span>';
    if ($(this).html() !== loadingText) {
      $this.data('original-text', $(this).html());
      $this.html(loadingText);
    }
    setTimeout(function() {
      $this.html($this.data('original-text'));
    }, 10000);
  });
})

//Saving animation
$(document).ready(function() {
  $('.btn-save').on('click', function() {
    var $this = $(this);
    var loadingText = '<span class="small"><i class="fa fa-spinner fa-spin fa-fw"></i> Saving...</span>';
    if ($(this).html() !== loadingText) {
      $this.data('original-text', $(this).html());
      $this.html(loadingText);
    }
    setTimeout(function() {
      $this.html($this.data('original-text'));
    }, 10000);
  });
})

//print specific page
function printDiv(divName) {
  var printContents = document.getElementById(divName).innerHTML;
  var originalContents = document.body.innerHTML;
  document.body.innerHTML = printContents;
  window.print();
  document.body.innerHTML = originalContents;
}

//toast
$(document).ready(function(){
  $('.toast').toast('show');
});

//alert dismissal
window.setTimeout(function()
{
  $(".alert").fadeTo(500, 0).slideUp(500, function()
  {
    $(this).remove(); 
  });
}, 15000);

//csrf token
$.ajaxSetup({ 
  headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});




