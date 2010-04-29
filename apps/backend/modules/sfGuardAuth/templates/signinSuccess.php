<div class="form" id="login">
  <?php echo form_tag('@sf_guard_signin') ?>
    <table class="doctrine_table rounded_corners">
      <thead>
        <tr><th colspan="2">Signin</th></tr>
      </thead>
      <?php echo $form ?>
      <tfoot>
        <tr><th colspan="2"><input type="submit" value="sign in" /></th></tr>
      </tfoot>
    </table>
  </form>
</div>