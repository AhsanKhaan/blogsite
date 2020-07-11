 <style>
 	/*Loader CSS*/
		#spinner.active {
		    display: inline-block;
		}
		#spinner {
		    display: none;
		    transform: scale(.4);
		    position: relative;
		    width: 20px;
		    top: -18px;
		    right: 5px;
		}
		.ball {
		    position: absolute;
		    display: block;
		    background-color: #fff;
		    left: 24px;
		    width: 12px;
		    height: 12px;
		    border-radius: 6px;
		}
		#first {
		    animation-timing-function: cubic-bezier(0.5, 0.3, 0.9, 0.9);
		    animation-name: rotate; 
		    animation-duration: 2s; 
		    animation-iteration-count: infinite;
		    transform-origin: 6px 30px;
		    animation-timing-function: cubic-bezier(0.5, 0.3, 0.9, 0.9);
		    animation-name: rotate; 
		    animation-duration: 2s; 
		    animation-iteration-count: infinite;
		    transform-origin: 6px 30px;

		}
		#second {
		    animation-timing-function: cubic-bezier(0.5, 0.5, 0.9, 0.9);
		    animation-name: rotate; 
		    animation-duration: 2s; 
		    animation-iteration-count: infinite;
		    transform-origin: 6px 30px;
		      animation-timing-function: cubic-bezier(0.5, 0.5, 0.9, 0.9);
		    animation-name: rotate; 
		    animation-duration: 2s; 
		    animation-iteration-count: infinite;
		    transform-origin: 6px 30px;
		}
		#third {
		    animation-timing-function: cubic-bezier(0.5, 0.7, 0.9, 0.9);
		    animation-name: rotate; 
		    animation-duration: 2s; 
		    animation-iteration-count: infinite;
		    transform-origin: 6px 30px;
		      animation-timing-function: cubic-bezier(0.5, 0.7, 0.9, 0.9);
		    animation-name: rotate; 
		    animation-duration: 2s; 
		    animation-iteration-count: infinite;
		    transform-origin: 6px 30px;
		}
		@keyframes rotate {
		  0% {
		    transform: rotate(0deg) scale(1);
		  }
		  100% { 
		    transform: rotate(1440deg) scale(1); 
		  }
		}​

		@keyframes rotate {
		  0% {
		    transform: rotate(0deg) scale(1);
		  }
		  100% { 
		    transform: rotate(1440deg) scale(1); 
		  }
		}
		/*Loader CSS*/
		.submitbtn{position: relative; font-size: 15px;}
 </style>

 <button type="submit" class="btn-info <?php echo $SubmitBTNClass; ?> btn btn-sm  uppercase bold submitbtn" name="submit" <?php echo $DisabledSubmitBTN == FALSE ? NULL : 'disabled="true"' ; ?>>  <?php echo $ButtonText ?>
   <div id="spinner" class="spinner">
        <span id="first" class="ball"></span>
        <span id="second" class="ball"></span>
        <span id="third" class="ball"></span>
    </div>
</button>