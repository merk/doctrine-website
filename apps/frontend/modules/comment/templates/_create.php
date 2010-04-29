<?php use_helper('I18N'); ?>

<div class="add">
  <a name="add_comment"></a>
  <?php $commentsId = 'comments_'.$record_id.'_'.$record_type; ?>
  <?php $addId = 'add_'.$record_id.'_'.$record_type; ?>

  <?php echo form_tag('comment/create'); ?>
    <?php if ($referer = $sf_request->getParameter('referer')): ?>
      <input type="hidden" name="referer" value="<?php echo $referer; ?>" />
    <?php endif; ?>

    <?php if (!$referer && $referer = $sf_request->getUri()): ?>
      <input type="hidden" name="referer" value="<?php echo $referer; ?>" />
    <?php endif; ?>


    <div class="form">
      <?php echo $form->renderGlobalErrors() ?>
      <?php echo $form->renderHiddenFields() ?>

      <fieldset>
        <legend><?php echo __('Create Comment'); ?></legend>

        <div class="form-row" id="record_comment_poster">
          <?php echo $form['poster']->renderError(); ?>
          <?php echo $form['poster']->renderLabel(); ?>
          <?php echo $form['poster']; ?>
        </div>

        <div class="form-row" id="record_comment_subject">
          <?php echo $form['subject']->renderError(); ?>
          <?php echo $form['subject']->renderLabel(); ?>
          <?php echo $form['subject']; ?>
        </div>

        <div class="form-row" id="record_comment_body">
          <?php echo $form['body']->renderError(); ?>
          <?php echo $form['body']->renderLabel(); ?>
          <?php echo $form['body']; ?>
        </div>

        <div class="form-row" id="record_comment_captcha">
          <?php echo $form['captcha']->renderError(); ?>
          <?php echo $form['captcha']->renderLabel(); ?>
          <?php echo $form['captcha']; ?>
        </div>
      </fieldset>

      <input type="submit" name="submit" value="save" />
    </div>
  </form>
</div>