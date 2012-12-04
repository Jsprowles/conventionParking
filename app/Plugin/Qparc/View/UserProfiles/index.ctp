<div style="width:100%;">
<h2>My Profile</h2>
<span style="float:right;position:relative;bottom:30px;">
	<?php if (isset($this->data['UserProfile']['paymentProfileId'])): ?>
		<a href="#" onclick="AuthorizeNetPopup.openEditPaymentPopup('<?=$this->data['UserProfile']['paymentProfileId']?>')">Edit Payment Method</a>
	<?php endif; ?>
	
</span>
</div>
<div class="userProfile" id="userProfile">
    <br/>
    <?php if (!isset($this->data['UserProfile']['paymentProfileId'])): ?>
		<script>
			$(document).ready(function () {
				$.growlUI('No Payment Method', 'Please add a Payment Method to Reserve a Space.');
					
			});
		</script>
		<a href="#" id="addPaymentLink" onclick="AuthorizeNetPopup.openAddPaymentPopup()"><strong>* First, Click Here to Securely Add a Payment Method</strong></a>
		<br/><br/>
	<?php endif; ?>
    <?php echo $this->Form->create('UserProfile',array('url' => array('controller'=>'user_profile','action' => 'add',$this->data['User']['id'])));?>
        <?php
        	
        	//echo "<span><a id='resetPasswordLink' href='#'>Reset Password</a></span><br/><br/>";
        	// USER
        	echo $this->Form->input('User.id',array('type'=>'hidden'));
			echo $this->Form->input('UserProfile.cim',array('type'=>'hidden'));
        	echo $this->Form->input('User.name', array('label'=>false,'title'=>'Full Name'));
			echo $this->Form->input('User.email', array('label'=>false,'title'=>'Email Address'));
        	// PROFILE
        	$options = array('Automatic'=>'Automatic','Manual'=>'Manual');
			if (isset($this->data['UserProfile']['trans']))
				$attr = array('legend'=>false,'value'=>$this->data['UserProfile']['trans']);
			else $attr = array('legend'=>false,'value'=>'Automatic');
			echo $this->Form->input('UserProfile.id',array('type'=>'hidden'));
			echo $this->Form->input('UserProfile.user_id',array('type'=>'hidden'));
        	echo $this->Form->input('UserProfile.phone',array('label'=>false,'title'=>'Phone Number'));
            echo $this->Form->input('UserProfile.vehicle',array('label'=>false,'title'=>'Vehicle'));
			echo $this->Form->input('UserProfile.plate',array('label'=>false,'title'=>'Plate Number'));
			echo "<br/>";
			echo $this->Form->end("Save Profile"); 
        ?>
        <div id="profileValidation" class="validation-error"></div>
       
        <br/><br/>
        	<h2>Password Reset</h2>
        <div id='resetPassword'>
        	<br/>
	        <?php
	        echo $this->Form->create('UserProfile',array('url' => array('controller'=>'user_profile','action' => 'reset_password',$this->data['User']['id'])));
			echo $this->Form->input('User.id');
			echo $this->Form->input('User.username', array('type' => 'hidden'));
			echo $this->Form->input('User.current_password',array('label'=>false,'type'=>'password','value'=>'','title'=>'Current Password'));
			echo $this->Form->input('User.password',array('label'=>false,'type'=>'password','value'=>'','title'=>'New Password'));
			echo "<br/>";	
			echo $this->Form->end('Update Password'); 
			?>
		</div>
</div>

<form method="post" action="https://secure.authorize.net/hosted/profile/manage" id="formAuthorizeNetPopup" name="formAuthorizeNetPopup" target="iframeAuthorizeNet" style="display:none;">
  <input type="hidden" name="Token" value="<?=$this->data['UserProfile']['auth_token'];?>" />
  <?php if (isset($this->data['UserProfile']['paymentProfileId'])): ?>
  <input type="hidden" name="PaymentProfileId" value="<?=$this->data['UserProfile']['paymentProfileId']?>" />
  <?php endif; ?>
</form>

<div id="divAuthorizeNetPopup" style="display:none;" class="AuthorizeNetPopupGrayFrameTheme">
  <div class="AuthorizeNetPopupOuter">
    <div class="AuthorizeNetPopupTop">
      <div class="AuthorizeNetPopupClose">
        <a href="javascript:;" onclick="AuthorizeNetPopup.closePopup();" title="Close"> </a>
      </div>
    </div>
    <div class="AuthorizeNetPopupInner">
      <iframe name="iframeAuthorizeNet" id="iframeAuthorizeNet" src="contentx/empty.html" frameborder="0" scrolling="no"></iframe>
    </div>
    <div class="AuthorizeNetPopupBottom">
      <div class="AuthorizeNetPopupLogo" title="Powered by Authorize.Net"></div>
    </div>
  </div>
  <div class="AuthorizeNetShadow AuthorizeNetShadowT"></div>
  <div class="AuthorizeNetShadow AuthorizeNetShadowR"></div>
  <div class="AuthorizeNetShadow AuthorizeNetShadowB"></div>
  <div class="AuthorizeNetShadow AuthorizeNetShadowL"></div>
  <div class="AuthorizeNetShadow AuthorizeNetShadowTR"></div>
  <div class="AuthorizeNetShadow AuthorizeNetShadowBR"></div>
  <div class="AuthorizeNetShadow AuthorizeNetShadowBL"></div>
  <div class="AuthorizeNetShadow AuthorizeNetShadowTL"></div>
</div>

<div id="divAuthorizeNetPopupScreen" style="display:none;"></div>