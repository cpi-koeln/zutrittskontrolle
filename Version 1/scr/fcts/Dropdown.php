<?php
/// Fehler kann in Zeile 34 (if unique) auftreten, wenn es in der zu suchenden Spalte keine Duplikate gibt.

function DropDown($array){

$first=$array[0]
	?>


		 <div id='schwimmbaeder' class="">
			 <div class="mt-1 relative">
				 <button id='schwimmbadButton'  type="button" class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
					 <span class="flex items-center">
						 <span class="ml-3 block truncate">
							 <?php
								echo $first;
								$active=$first;
								?>
						 </span>
					 </span>
					 <input type="hidden"  id="schwimmbad" name="schwimmbad" value='<?php echo $first;?>'/>

					 <span class="ml-3 absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
						 <svg class="h-5 w-5 text-gray-400 " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
							 <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
						 </svg>
					 </span>
				 </button>

				 <ul id="schwimmbadUl"   class="  hidden absolute z-10 mt-1 w-full bg-white shadow-lg max-h-56 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm" tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-option-3">
					 <?php
					 $counter=0;
					 $haken=0;
						foreach($array as $entry)
							{
								$svgClass="h-5 w-5 hidden";
								if ($counter+1>=1) // die 1 war $lineNR
									{
										if($haken==0)
											{
												$svgClass="h-5 w-5 visible";
												$haken=1;
											};
										};
							 $counter++;
						?>
					 <li id="<?php echo $entry;?>"   class='click text-gray-900 cursor-default select-none relative py-2 pl-3 pr-9' id="listbox-option-0" role="option">
						 <div class=" flex items-center">
							 <!-- Selected: "font-semibold", Not Selected: "font-normal" -->
							 <span class="font-normal ml-3 block truncate">
								 <?php echo $entry; ?>
							 </span>
						 </div>
						 <!--
							 Checkmark, only display for selected option.

							 Highlighted: "text-white", Not Highlighted: "text-indigo-600"
						 -->
						 <span class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-4">
							 <!-- Heroicon name: solid/check -->
							 <svg class='<?php echo $svgClass;?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
								 <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
							 </svg>
						 </span>
					 </li>
				 <?php }; ?>
				 </ul>
			 </div>
		 </div>
<?php
}


/*----------------------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
------------------------------------------------------------------------------------------
---------------------------------------------------------------------------------------------*/


function DropDownCharge($artId,$lineNr,$einzelBestaende){
	if( $lineNr==0) //im Fall des DropdownMenüs in der Haupttabelle
		{
			$zeile=0;
		}
	else
		{
			$zeile=$lineNr-1;
		};

	$firstChgName=$einzelBestaende[$zeile]->chgAbl;

	$firstLao=$einzelBestaende[$zeile]->laoName;
	$firstMenge=$einzelBestaende[$zeile]->menZahl;
	$firstLagId=$einzelBestaende[$zeile]->lagId;

	?>
	<!-- Ab hier DropDown-Meü für Lagerort

	articlesById=[$artId,$artName,[$laoName],[$article->menZahl]];
	einzelBestaende=[$einzelBestand->lagId,$laoName,$chgAbl,$einzelBestand->menZahl];
	benötigt: artId,einzelbestaende=[laoName,lagId]
	-->

		 <div id='<?php echo "charge".$artId;?>' class="">
			 <div class="mt-1 relative">
				 <button id='<?php echo "buttonCharge".$artId."_".$lineNr;?>' menge="<?php echo $firstMenge;?>" charge="<?php echo $firstChgName;?>" lao="<?php echo $firstLao;?>" name='<?php echo "charge".$artId."_".$lineNr;?>' type="button" class='<?php echo "artId".$artId." buttonCharge relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm";?>' aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
					 <span class="flex items-center">
						 <span menge='<?php echo $firstMenge;?>' class='<?php echo "ml-3 block truncate chargeButton".$lineNr;?>'>
							 <?php
								echo $firstChgName;
								$activeChg=$firstChgName;

								?>
						 </span>
					 </span>
					 <input type="hidden"  id='<?php echo "charge_".$artId."_".$lineNr;?>'  name='<?php echo "charge_".$artId."_".$lineNr;?>' value='<?php echo $firstChgName;?>'/>
					 <input type="hidden"  id='<?php echo "lagId_".$artId."_".$lineNr;?>'  name='<?php echo "lagId_".$artId."_".$lineNr;?>' value='<?php echo $firstLagId;?>'/>
					 <span class="ml-3 absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
						 <svg class="h-5 w-5 text-gray-400 " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
							 <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
						 </svg>
					 </span>
				 </button>

				 <ul id="<?php echo "charge".$artId."_".$lineNr;?>"  ul='<?php echo$ $artId;?>' class='<?php echo" ul".$artId." hidden charge absolute z-10 mt-1 w-full bg-white shadow-lg max-h-56 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm";?>' tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-option-3">
					 <?php
					 $counter=0;
					 $haken=0;
						foreach($einzelBestaende as $einzelBestand)
							{
								$svgClass="h-5 w-5 hidden";
								if ($counter+1>=$lineNr)
									{
										if($haken==0)
											{
												$svgClass="h-5 w-5 visible";
												$haken=1;
											};
										};
							 $counter++;
						?>
					 <li  artId='<?php echo $einzelBestand->refArtId;?>' lagId='<?php echo $einzelBestand->lagId;?>' name="<?php echo $einzelBestand->chgAbl;?>" menge="<?php echo $einzelBestand->menZahl;?>" lao="<?php echo $einzelBestand->laoName;?>" buttonId="<?php echo $einzelBestand->refArtId."_".$lineNr;?>" class='<?php echo "lineNr".$lineNr." clickCharge text-gray-900 cursor-default select-none relative py-2 pl-3 pr-9";?>' id="listbox-option-0" role="option">
						 <div class=" flex items-center">
							 <!-- Selected: "font-semibold", Not Selected: "font-normal" -->
							 <span class="font-normal ml-3 block truncate">
								 <?php echo $einzelBestand->chgAbl; ?>
							 </span>
						 </div>
						 <!--
							 Checkmark, only display for selected option.

							 Highlighted: "text-white", Not Highlighted: "text-indigo-600"
						 -->
						 <span class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-4">
							 <!-- Heroicon name: solid/check -->
							 <svg class='<?php echo $svgClass;?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
								 <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
							 </svg>
						 </span>
					 </li>
				 <?php }; ?>
				 </ul>
			 </div>
		 </div>
<?php
}


function DropDownLaoTyp($laoTyps){

	$firstLaoTyp=$laoTyps[0][1];
	?>
		 <div  class="relative w-max">
				 <button id='buttonLaoTyp' laoTypZusId="1" type="button" class="w-max relative  bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
					 <span class="flex items-center">
						 <span class="ml-3 block truncate">
							 <?php
								echo $firstLaoTyp;
								$activeLaoTyp=$firstLaoTyp;
								?>
						 </span>
					 </span>
					 <input type="hidden"  id='laoTyp' name='laoTypZusName' value='<?php echo $firstLaoTyp;?>'/>
					 <input type="hidden"  id='laoTypZusId' name='laoTypZusId' value='<?php echo $laoTyps[0][0];?>'/>
					 <span class="ml-3 absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
						 <svg class="h-5 w-5 text-gray-400 " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
							 <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
						 </svg>
					 </span>
				 </button>

				 <ul id="ul1"  class=" hidden absolute z-10 mt-1 w-full bg-white shadow-lg max-h-56 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm" tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-option-3">
					 <?php
					 $haken=0;
						foreach($laoTyps as $laoTyp)
							{

								$svgClass="h-5 w-5 hidden";
										if($haken==0)
											{
												$svgClass="h-5 w-5 visible";
												$haken=1;
											};
							?>
					 <li  name="<?php echo $laoTyp[1];?>" laoTypZusId="<?php echo $laoTyp[0];?>" buttonId="buttonLaoTyp" class='clickLaoTyp text-gray-900 cursor-default select-none relative py-2 pl-3 pr-9' id="listbox-option-0" role="option">
						 <div class=" flex items-center">
							 <span class="font-normal ml-3 block truncate">
								 <?php echo $laoTyp[1]; ?>
							 </span>
						 </div>
						 <span class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-4">
							 <svg class='<?php echo $svgClass;?>' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
								 <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
							 </svg>
						 </span>
					 </li>
				 <?php }; ?>
				 </ul>
		 </div>
<?php
}
?>
