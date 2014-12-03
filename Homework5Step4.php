<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "
    http://www.w3.org/TR/htm14/strict.dtd">

<html>

    <head>

        <title> Homework 5 - Step 4: Interactive Dynamic Content Moderate </title>

        <!-- Embedded Styles: only have to define once -->
        <style type="text/css">

            body 
            {
                font-family: Arial;
                font-size: 11pt;
            }

            div.BlackBar 
            {
                background-color: black;
                color: white;
                height: 28px;
                font-size: 14pt;
                padding-top: 5px;
                padding-left: 3px;
            }

            /* Form */
            #frmSimpleCalculator 
            {
                background-color: #DDDDDD;
                width: 215px;
                text-align:center;
                line-height: 28px;
            }

            fieldset 
            {
                color: #00f;
                background-color: #ddd;
            }

            legend 
            {   
                color: black;
                text-align: left;
            }

            /* Label */
            label 
            {
                display: inline-block;      /* otherwise ignores height and width */
                width: 70px;
                text-align: left;
                color: black;
            }

            /* TextBox */
            input[type=text] 
            {
                text-align:right;
            }

            hr 
            {
                border-color: #ddd
            }

            /* Buttons */
            input[type=button]
           ,input[type=submit]  
            {
                width: 150px;
                margin-top: 5px;
            }

        </style>
        
        
        <!-- ------------------------------------------------------------------------------
        // --------------------------------------------------------------------------------
        // Name: PHP / Server Side
        // --------------------------------------------------------------------------------
        // ---------------------------------------------------------------------------- -->
  		<?php
    
		// Get the value of the textbox's and combobox
        $intTxtValue1 = $_GET["txtValue1"];
        $intOperation = $_GET["cmbOperation"];
        $strOperation = "";
        $intTxtValue2 = $_GET["txtValue2"];
        $strMessage = "";
        $intTotal = 0;
    
        switch ($intOperation)
        {
            case 1: 
                $intTotal = $intTxtValue1 + $intTxtValue2;
                $strOperation = "+";
                break;
                
            case 2: 
                $intTotal = $intTxtValue1 - $intTxtValue2;
                $strOperation = "-";                
                break;
                            
            case 3: 
                $intTotal = $intTxtValue1 * $intTxtValue2;
                $strOperation = "*";                
                break;
                            
            case 4: 
                // Only Chuck Norris can divide by zero
                if ($intTxtValue2 != 0 ) 
                {
                    $intTotal = $intTxtValue1 / $intTxtValue2;
                }
                else 
                {
                    $strMessage = "Only Chuck Norris can divide by zero, bro!!!";			
                    echo "<script type='text/javascript'>alert('$strMessage');</script>";
                }             
         }
    
        ?>  

        <!-- ------------------------------------------------------------------------------
        // --------------------------------------------------------------------------------
        // Name: JavaScript / Client Side
        // --------------------------------------------------------------------------------
        // ---------------------------------------------------------------------------- -->
        <script language="javascript" type="text/javascript">
            
        
        	// --------------------------------------------------------------------------------
            // Name: Body_OnLoad
            // Abstract:  Body OnLoad
            // --------------------------------------------------------------------------------
			function Body_OnLoad()
			{
				var frmSimpleCalculator = document.getElementById("frmSimpleCalculator");
				
				frmSimpleCalculator.txtValue1.value = "<?php echo $intTxtValue1 ?>";
				frmSimpleCalculator.cmbOperation.value = "<?php echo $intOperation ?>";
				frmSimpleCalculator.txtValue2.value = "<?php echo $intTxtValue2 ?>";
				frmSimpleCalculator.txtTotal.value = "<?php echo $intTotal ?>";				
			}
			
			
			
		    // --------------------------------------------------------------------------------
            // Name: btnCalculateTotal_Click
            // Abstract: Do the math if the data is good
            // --------------------------------------------------------------------------------
			function btnCalculateTotal_Click()
			{
				var frmSimpleCalculator = document.getElementById("frmSimpleCalculator");
				
				if (IsValidData() == true)
				{
					frmSimpleCalculator.submit()
				}	
			}	


            // --------------------------------------------------------------------------------
            // Name: IsValidData
            // Abstract:  Is the data valid
            // --------------------------------------------------------------------------------
            function IsValidData() 
			{
                var blnIsValidData = true;
                var strErrorMessage = "Please correct the following error(s):\n";
                var frmSimpleCalculator = document.getElementById("frmSimpleCalculator");

                // Value 1
				if(frmSimpleCalculator.txtValue1.value == "")
				{
					strErrorMessage += "-Value 1 can not be blank\n";
					blnIsValidData = false;	
				}
				
				if (isNaN(frmSimpleCalculator.txtValue1.value) == true)
				{
					strErrorMessage += "-Value 1 must be numberic\n";
					blnIsValidData = false;
				}
				
				// Value 2
				if(frmSimpleCalculator.txtValue2.value == "")
				{
					strErrorMessage += "-Value 2 can not be blank\n";
					blnIsValidData = false;	
				}

				// Value 2 
				if (isNaN(frmSimpleCalculator.txtValue2.value) == true)
				{
					strErrorMessage += "-Value 2 must be numberic\n";
					blnIsValidData = false;
				}

				// Bad data?
				if (blnIsValidData == false)
				{
					// Yes, warn the user 
					alert(strErrorMessage);
				}
	
                return blnIsValidData;

            }



            // --------------------------------------------------------------------------------
            // Name: btnClear_Click
            // Abstract:  Clear the form programatically
            // --------------------------------------------------------------------------------
            function btnClear_Click()
            {
                var frmSimpleCalculator = document.getElementById("frmSimpleCalculator");                               

                frmSimpleCalculator.txtValue1.value = "";
                frmSimpleCalculator.cmbOperation.selectedIndex = 0;                
                frmSimpleCalculator.txtValue2.value = "";
                frmSimpleCalculator.txtTotal.value = "";
            }  

        </script>
        
    </head>
    
    <body onload="Body_OnLoad();">

        Name: Brandon Roberts <br />
        Class: PHP <br />
        Abstract: Homework #5 - Step 4 - Interactive Dynamic Content - Moderate <br />
        <br />
        <div class="BlackBar"> Homework#5 - Come to the Server Side </div>
        <br />

        <form name="frmSimpleCalculator" id="frmSimpleCalculator" action="Homework5Step4.php" method="get">

            <fieldset>

                <legend> Simple Calculator </legend>

                <!-- Value 1 -->
                <label for="txtValue1"> Value 1: </label> 
                <input type="text" name="txtValue1" id="txtValue1" value="" 
                 size="10" maxlength="5" /> <br />

                <!-- Operation -->
                <select name="cmbOperation" id="cmbOperation" />
                    <option value="1"> + </option>
                    <option value="2"> - </option>
                    <option value="3"> * </option>
                    <option value="4"> / </option>
                </select > <br />

                <!-- Value 2 -->
                <label for="txtValue2"> Value 2: </label> <input type="text" name="txtValue2" 
                 id="txtValue2" value="" size="10" maxlength="5" /> <br />

                <hr style="width: 95%"/>

                <!-- Total -->
                <label for="txtTotal"> Total: </label> 
            	<input type="text" name="txtTotal" id="txtTotal" value="" 
            	 size="10" action="" readonly /> <br />

                <!-- Calculate Total -->
                <input type="submit" name="btnCalculateTotal" id="btnCalculateTotal" 
                	value="Calculate Total" onClick="btnCalculateTotal_Click();" <br />

                <!-- Clear -->
                <input type="button" name="btnClear" id="btnClear"
                    value="Clear" onclick="btnClear_Click();" /> <br />

            </fieldset>

        </form>

    </body>

</html>
        

