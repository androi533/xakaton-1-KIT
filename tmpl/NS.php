<?php 
   class Perceptron{ 
      public $mul; //отмасштабированные сигналы 
      public $weight; //коэфициенты связей 
      public $sinaps; //синапсы 
      public $sizeX; 
      public $sizeY; 
      public $filename; 
      public $sum; //сумма сигналов 
      public $limit; //порог 
       
      public function __construct($filename){ 
         $this->sizeX=3; 
         $this->sizeY=5; 
         $this->limit=100; 
         $this->filenameW="wp/w".$filename.".txt"; 
      } 
      public function set_filenameP($filename){ 
         $this->filenameP="wp/p".$filename.".png"; 
      } 
      public function save_weight_file(){ 
         $serialize = serialize($this->weight); 
         fwrite( fopen($this->filenameW,"w"), $serialize); 
      } 
      public function load_weight_file(){ 
         if(file_exists($this->filenameW)){ 
            $this->weight = unserialize(file_get_contents($this->filenameW)); 
         }else{ 
            for($x=0;$x<$this->sizeX;$x++){ 
               for($y=0;$y<$this->sizeY;$y++){ 
                  $this->weight[$x][$y]="0"; 
               } 
            } 
         } 
      } 
      public function load_file(){ 
         $im = imagecreatefrompng($this->filenameP); 
         for($x=0;$x<$this->sizeX;$x++){ 
            for($y=0;$y<$this->sizeY;$y++){ 
               $rgb = imagecolorat($im, $x, $y); 
               $color=imagecolorsforindex($im, $rgb); 
               if($color['red']>127){ 
                  $color=0; 
               }else{ 
                  $color=1; 
               } 
               $this->sinaps[$x][$y]=$color; 
            } 
         } 
         imagedestroy($im); 
      } 
      public function mul_weights(){ 
         for($x=0;$x<$this->sizeX;$x++){ 
            for($y=0;$y<$this->sizeY;$y++){ 
               $this->mul[$x][$y]=$this->sinaps[$x][$y]*$this->weight[$x][$y]; 
            } 
         } 
      } 
      public function sum_muls(){ 
         $this->sum=0; 
         for($x=0;$x<$this->sizeX;$x++){ 
            for($y=0;$y<$this->sizeY;$y++){ 
               $this->sum+=$this->mul[$x][$y]; 
            } 
         } 
      } 
      public function porog(){ 
         if($this->sum >= $this->limit){ 
            return true; //true - отнимаем 
         }else{ 
            return false; //false - прибавляем 
         } 
      } 
      public function teach_plus(){ 
         for($x=0;$x<$this->sizeX;$x++){ 
            for($y=0;$y<$this->sizeY;$y++){ 
               $this->weight[$x][$y]+=$this->sinaps[$x][$y]; 
            } 
         } 
      } 
      public function teach_minus(){ 
         for($x=0;$x<$this->sizeX;$x++){ 
            for($y=0;$y<$this->sizeY;$y++){ 
               $this->weight[$x][$y]-=$this->sinaps[$x][$y]; 
            } 
         } 
      } 
   } 
   for($i=0;$i<10;$i++){ 
      echo "<img style=\"border:1px solid #000000;\" src=\"wp/p".$i.".png\" width=\"30\" height=\"50\" /> "; 
   } 
   echo "<form style=\"padding-bottom:10px;\" action=\"".$_SERVER['PHP_SELF']."\" method=\"get\">\n"; 
   echo "Изучить выбранную картинку <input type=\"text\" name=\"n\" value=\""; 
   echo (int)$_GET['n']; 
   echo "\" /><br>\n"; 
   echo "Очистить коэффициенты связей <input type=checkbox Name=\"del\"/><br>"; 
   echo "<input type=\"submit\" value=\"Поехали!\" /><br>\n"; 
   echo "</form>\n"; 
    
   if(isset($_GET['del'])){ 
      for($i=0;$i<10;$i++){ 
         $fp="wp/w".$i.".txt"; 
         if(file_exists($fp)){ 
            unlink($fp); 
         } 
      } 
      echo "Коэффициенты связей очищены. Можете заново обучить нашуй нейронную сеть :)<br>\n"; 
   }else{ 
      if((isset($_GET['n']))&&($_GET['n']>=0)&&($_GET['n']<=9)){ 
         $n=(int)$_GET['n']; 
         echo "Грузим картинку ".$n.".<br>\n<br>\n"; 
         echo "<img src=\"wp/p".$n.".png\" width=\"30\" height=\"50\" /><br>\n<br>\n"; 
         do{ 
         $errors=0; 
            for($i=0;$i<10;$i++){ 
               $perc[$i]=new Perceptron($i); 
               $perc[$i]->set_filenameP($n); 
               $perc[$i]->load_weight_file(); 
               $perc[$i]->load_file(); 
               $perc[$i]->mul_weights(); 
               $perc[$i]->sum_muls(); 
               $porog[$i]=$perc[$i]->porog(); 
               $say="false"; 
               if($porog[$i]){ 
                  $say="true"; 
               } 
               echo "Нейрон ".$i." сказал ".$say; 
               if($i==$n){ 
                  if($porog[$i]==true){ 
                     /*$perc[$i]->teach_minus();*/ 
                  }else{ 
                     $perc[$i]->teach_plus(); 
                     echo ", учим нейрон ".$i." не говорить чепуху (плюсуем веса)."; 
                     $errors++; 
                  } 
               }else{ 
                  if($porog[$i]==true){ 
                     $perc[$i]->teach_minus(); 
                     echo ", учим нейрон ".$i." не говорить чепуху (минусуем веса)."; 
                     $errors++; 
                  }else{ 
                     /*$perc[$i]->teach_plus();*/ 
                  } 
               } 
               echo "<br>\n"; 
               $perc[$i]->save_weight_file(); 
            } 
            echo "Наша нейронная сеть ошиблася ".$errors." раз."; 
            if($errors>0){ 
               echo " Продолжаем обучаться<br>\n<br>\n"; 
            }else{ 
               $finded=array_search('true', $porog); 
               echo "<br>\nНейронная сеть определила на картинке: <span style=\"font-weight: bold; font-size:18px;\">".$finded."</span> <br>\n"; 
            } 
         }while($errors!=0); 
      } 
   } 
?> 