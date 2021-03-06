<?hh
// Copyright 2004-present Facebook. All Rights Reserved.

/**
 * Ephemeron.php
 */

namespace Rehack;

final class Ephemeron {
  <<__Memoize>>
  public static function get() {
    $global_object = \Rehack\GlobalObject::get();
    $runtime = \Rehack\Runtime::get();
    /*
     * Soon, these will replace the `global_data->ModuleName`
     * pattern in the load() function.
     */
    $Array_ = Array_::get();
    $CamlinternalLazy = CamlinternalLazy::get();
    $Hashtbl = Hashtbl::get();
    $Obj = Obj::get();
    $Pervasives = Pervasives::get();
    $Random = Random::get();
    $Sys = Sys::get();
    $Not_found = Not_found::get();
    Ephemeron::load($global_object);
    $memoized = $runtime->caml_get_global_data()->Ephemeron;
    return $memoized;
  }

  /**
   * Performs module load operation. May have side effects.
   */
  private static function load($joo_global_object) {
    

    $runtime = $joo_global_object->jsoo_runtime;
    $call1 = $runtime["caml_call1"];
    $call2 = $runtime["caml_call2"];
    $call3 = $runtime["caml_call3"];
    $call5 = $runtime["caml_call5"];
    $caml_check_bound = $runtime["caml_check_bound"];
    $caml_make_vect = $runtime["caml_make_vect"];
    $caml_wrap_exception = $runtime["caml_wrap_exception"];
    $left_shift_32 = $runtime["left_shift_32"];
    $unsigned_right_shift_32 = $runtime["unsigned_right_shift_32"];
    $global_data = $runtime["caml_get_global_data"]();
    $Obj = $global_data["Obj"];
    $Sys = $global_data["Sys"];
    $Not_found = $global_data["Not_found"];
    $Pervasives = $global_data["Pervasives"];
    $Array = $global_data["Array_"];
    $Hashtbl = $global_data["Hashtbl"];
    $CamlinternalLazy = $global_data["CamlinternalLazy"];
    $Random = $global_data["Random"];
    $z5 = Vector{0, 0};
    $z4 = Vector{0, 0};
    $z3 = Vector{0, 0};
    $MakeSeeded = function(dynamic $H) use ($Array,$CamlinternalLazy,$Hashtbl,$Not_found,$Pervasives,$Random,$Sys,$call1,$call2,$call3,$caml_check_bound,$caml_make_vect,$caml_wrap_exception,$insert_bucket,$left_shift_32,$runtime,$unsigned_right_shift_32) {
      $power_2_above = function(dynamic $x, dynamic $n) use ($Sys) {
        $x__0 = $x;
        for (;;) {
          if ($n <= $x__0) {return $x__0;}
          if ($Sys[14] < (int) ($x__0 * 2)) {return $x__0;}
          $x__1 = (int) ($x__0 * 2);
          $x__0 = $x__1;
          continue;
        }
      };
      $prng = Vector{
        246,
        function(dynamic $Be) use ($Random,$call1) {
          return $call1($Random[11][2], 0);
        }
      };
      $create = function(dynamic $opt, dynamic $initial_size) use ($CamlinternalLazy,$Hashtbl,$Random,$call1,$caml_make_vect,$power_2_above,$prng,$runtime) {
        if ($opt) {
          $sth = $opt[1];
          $random = $sth;
        }
        else {$random = $call1($Hashtbl[17], 0);}
        $s = $power_2_above(16, $initial_size);
        if ($random) {
          $Bc = $runtime["caml_obj_tag"]($prng);
          $Bd = 250 === $Bc
            ? $prng[1]
            : (246 === $Bc ? $call1($CamlinternalLazy[2], $prng) : ($prng));
          $seed = $call1($Random[11][4], $Bd);
        }
        else {$seed = 0;}
        return Vector{0, 0, $caml_make_vect($s, 0), $seed, $s};
      };
      $clear = function(dynamic $h) use ($caml_check_bound) {
        $h[1] = 0;
        $len = $h[2]->count() - 1;
        $Ba = (int) ($len + -1);
        $A_ = 0;
        if (! ($Ba < 0)) {
          $i = $A_;
          for (;;) {
            $caml_check_bound($h[2], $i)[$i + 1] = 0;
            $Bb = (int) ($i + 1);
            if ($Ba !== $i) {$i = $Bb;continue;}
            break;
          }
        }
        return 0;
      };
      $reset = function(dynamic $h) use ($caml_make_vect,$clear) {
        $len = $h[2]->count() - 1;
        if ($len === $h[4]) {return $clear($h);}
        $h[1] = 0;
        $h[2] = $caml_make_vect($h[4], 0);
        return 0;
      };
      $copy = function(dynamic $h) use ($Array,$call1) {
        $A7 = $h[4];
        $A8 = $h[3];
        $A9 = $call1($Array[8], $h[2]);
        return Vector{0, $h[1], $A9, $A8, $A7};
      };
      $key_index = function(dynamic $h, dynamic $hkey) {
        return $hkey & (int) ($h[2]->count() - 1 + -1);
      };
      $clean = function(dynamic $h) use ($H,$call1,$caml_check_bound) {
        $do_bucket = new Ref();
        $do_bucket->contents = function(dynamic $param) use ($H,$call1,$do_bucket,$h) {
          $param__0 = $param;
          for (;;) {
            if ($param__0) {
              $rest = $param__0[3];
              $c = $param__0[2];
              $hkey = $param__0[1];
              if ($call1($H[7], $c)) {
                return Vector{0, $hkey, $c, $do_bucket->contents($rest)};
              }
              $h[1] = (int) ($h[1] + -1);
              $param__0 = $rest;
              continue;
            }
            return 0;
          }
        };
        $d = $h[2];
        $A5 = (int) ($d->count() - 1 + -1);
        $A4 = 0;
        if (! ($A5 < 0)) {
          $i = $A4;
          for (;;) {
            $d[$i + 1] =
              $do_bucket->contents($caml_check_bound($d, $i)[$i + 1]);
            $A6 = (int) ($i + 1);
            if ($A5 !== $i) {$i = $A6;continue;}
            break;
          }
        }
        return 0;
      };
      $resize = function(dynamic $h) use ($Sys,$caml_check_bound,$caml_make_vect,$clean,$insert_bucket,$key_index,$unsigned_right_shift_32) {
        $odata = $h[2];
        $osize = $odata->count() - 1;
        $nsize = (int) ($osize * 2);
        $clean($h);
        $AY = $nsize < $Sys[14] ? 1 : (0);
        $AZ = $AY
          ? (int) $unsigned_right_shift_32($osize, 1) <= $h[1] ? 1 : (0)
          : ($AY);
        if ($AZ) {
          $ndata = $caml_make_vect($nsize, 0);
          $h[2] = $ndata;
          $insert_bucket->contents = function(dynamic $param) use ($caml_check_bound,$h,$insert_bucket,$key_index,$ndata) {
            if ($param) {
              $rest = $param[3];
              $data = $param[2];
              $hkey = $param[1];
              $insert_bucket->contents($rest);
              $nidx = $key_index($h, $hkey);
              $ndata[$nidx + 1] =
                Vector{
                  0,
                  $hkey,
                  $data,
                  $caml_check_bound($ndata, $nidx)[$nidx + 1]
                };
              return 0;
            }
            return 0;
          };
          $A1 = (int) ($osize + -1);
          $A0 = 0;
          if (! ($A1 < 0)) {
            $i = $A0;
            for (;;) {
              $insert_bucket->contents($caml_check_bound($odata, $i)[$i + 1]);
              $A3 = (int) ($i + 1);
              if ($A1 !== $i) {$i = $A3;continue;}
              break;
            }
          }
          $A2 = 0;
        }
        else {$A2 = $AZ;}
        return $A2;
      };
      $add = function(dynamic $h, dynamic $key, dynamic $info) use ($H,$call2,$caml_check_bound,$key_index,$left_shift_32,$resize) {
        $hkey = $call2($H[2], $h[3], $key);
        $i = $key_index($h, $hkey);
        $container = $call2($H[1], $key, $info);
        $bucket = Vector{
          0,
          $hkey,
          $container,
          $caml_check_bound($h[2], $i)[$i + 1]
        };
        $caml_check_bound($h[2], $i)[$i + 1] = $bucket;
        $h[1] = (int) ($h[1] + 1);
        $AX = $left_shift_32($h[2]->count() - 1, 1) < $h[1] ? 1 : (0);
        return $AX ? $resize($h) : ($AX);
      };
      $remove = function(dynamic $h, dynamic $key) use ($H,$call2,$caml_check_bound,$key_index) {
        $remove_bucket = new Ref();
        $hkey = $call2($H[2], $h[3], $key);
        $remove_bucket->contents = function(dynamic $param) use ($H,$call2,$h,$hkey,$key,$remove_bucket) {
          $param__0 = $param;
          for (;;) {
            if ($param__0) {
              $next = $param__0[3];
              $c = $param__0[2];
              $hk = $param__0[1];
              if ($hkey === $hk) {
                $match = $call2($H[3], $c, $key);
                switch($match) {
                  // FALLTHROUGH
                  case 0:
                    $h[1] = (int) ($h[1] + -1);
                    return $next;
                  // FALLTHROUGH
                  case 1:
                    return Vector{0, $hk, $c, $remove_bucket->contents($next)};
                  // FALLTHROUGH
                  default:
                    $h[1] = (int) ($h[1] + -1);
                    $param__0 = $next;
                    continue;
                  }
              }
              return Vector{0, $hk, $c, $remove_bucket->contents($next)};
            }
            return 0;
          }
        };
        $i = $key_index($h, $hkey);
        $AW = $remove_bucket->contents($caml_check_bound($h[2], $i)[$i + 1]);
        $caml_check_bound($h[2], $i)[$i + 1] = $AW;
        return 0;
      };
      $find_rec = function(dynamic $key, dynamic $hkey, dynamic $param) use ($H,$Not_found,$call1,$call2,$runtime) {
        $param__0 = $param;
        for (;;) {
          if ($param__0) {
            $rest = $param__0[3];
            $c = $param__0[2];
            $hk = $param__0[1];
            if ($hkey === $hk) {
              $match = $call2($H[3], $c, $key);
              switch($match) {
                // FALLTHROUGH
                case 0:
                  $match__0 = $call1($H[4], $c);
                  if ($match__0) {$d = $match__0[1];return $d;}
                  $param__0 = $rest;
                  continue;
                // FALLTHROUGH
                case 1:
                  $param__0 = $rest;
                  continue;
                // FALLTHROUGH
                default:
                  $param__0 = $rest;
                  continue;
                }
            }
            $param__0 = $rest;
            continue;
          }
          throw $runtime["caml_wrap_thrown_exception"]($Not_found) as \Throwable;
        }
      };
      $find = function(dynamic $h, dynamic $key) use ($H,$call2,$caml_check_bound,$find_rec,$key_index) {
        $hkey = $call2($H[2], $h[3], $key);
        $AV = $key_index($h, $hkey);
        return $find_rec($key, $hkey, $caml_check_bound($h[2], $AV)[$AV + 1]);
      };
      $find_rec_opt = function(dynamic $key, dynamic $hkey, dynamic $param) use ($H,$call1,$call2) {
        $param__0 = $param;
        for (;;) {
          if ($param__0) {
            $rest = $param__0[3];
            $c = $param__0[2];
            $hk = $param__0[1];
            if ($hkey === $hk) {
              $match = $call2($H[3], $c, $key);
              switch($match) {
                // FALLTHROUGH
                case 0:
                  $d = $call1($H[4], $c);
                  if ($d) {return $d;}
                  $param__0 = $rest;
                  continue;
                // FALLTHROUGH
                case 1:
                  $param__0 = $rest;
                  continue;
                // FALLTHROUGH
                default:
                  $param__0 = $rest;
                  continue;
                }
            }
            $param__0 = $rest;
            continue;
          }
          return 0;
        }
      };
      $find_opt = function(dynamic $h, dynamic $key) use ($H,$call2,$caml_check_bound,$find_rec_opt,$key_index) {
        $hkey = $call2($H[2], $h[3], $key);
        $AU = $key_index($h, $hkey);
        return $find_rec_opt(
          $key,
          $hkey,
          $caml_check_bound($h[2], $AU)[$AU + 1]
        );
      };
      $find_all = function(dynamic $h, dynamic $key) use ($H,$call1,$call2,$caml_check_bound,$key_index) {
        $find_in_bucket = new Ref();
        $hkey = $call2($H[2], $h[3], $key);
        $find_in_bucket->contents = function(dynamic $param) use ($H,$call1,$call2,$find_in_bucket,$hkey,$key) {
          $param__0 = $param;
          for (;;) {
            if ($param__0) {
              $rest = $param__0[3];
              $c = $param__0[2];
              $hk = $param__0[1];
              if ($hkey === $hk) {
                $match = $call2($H[3], $c, $key);
                switch($match) {
                  // FALLTHROUGH
                  case 0:
                    $match__0 = $call1($H[4], $c);
                    if ($match__0) {
                      $d = $match__0[1];
                      return Vector{0, $d, $find_in_bucket->contents($rest)};
                    }
                    $param__0 = $rest;
                    continue;
                  // FALLTHROUGH
                  case 1:
                    $param__0 = $rest;
                    continue;
                  // FALLTHROUGH
                  default:
                    $param__0 = $rest;
                    continue;
                  }
              }
              $param__0 = $rest;
              continue;
            }
            return 0;
          }
        };
        $AT = $key_index($h, $hkey);
        return $find_in_bucket->contents(
          $caml_check_bound($h[2], $AT)[$AT + 1]
        );
      };
      $replace = function(dynamic $h, dynamic $key, dynamic $info) use ($H,$Not_found,$call2,$call3,$caml_check_bound,$caml_wrap_exception,$key_index,$left_shift_32,$resize,$runtime) {
        $hkey = $call2($H[2], $h[3], $key);
        $replace_bucket = function(dynamic $param) use ($H,$Not_found,$call2,$call3,$hkey,$info,$key,$runtime) {
          $param__0 = $param;
          for (;;) {
            if ($param__0) {
              $next = $param__0[3];
              $c = $param__0[2];
              $hk = $param__0[1];
              if ($hkey === $hk) {
                $match = $call2($H[3], $c, $key);
                if (0 === $match) {return $call3($H[6], $c, $key, $info);}
                $param__0 = $next;
                continue;
              }
              $param__0 = $next;
              continue;
            }
            throw $runtime["caml_wrap_thrown_exception"]($Not_found) as \Throwable;
          }
        };
        $i = $key_index($h, $hkey);
        $l = $caml_check_bound($h[2], $i)[$i + 1];
        try {$AR = $replace_bucket($l);return $AR;}
        catch(\Throwable $AS) {
          $AS = $caml_wrap_exception($AS);
          if ($AS === $Not_found) {
            $container = $call2($H[1], $key, $info);
            $caml_check_bound($h[2], $i)[$i + 1] = Vector{0, $hkey, $container, $l};
            $h[1] = (int) ($h[1] + 1);
            $AQ = $left_shift_32($h[2]->count() - 1, 1) < $h[1] ? 1 : (0);
            return $AQ ? $resize($h) : ($AQ);
          }
          throw $runtime["caml_wrap_thrown_exception_reraise"]($AS) as \Throwable;
        }
      };
      $mem = function(dynamic $h, dynamic $key) use ($H,$call2,$caml_check_bound,$key_index) {
        $hkey = $call2($H[2], $h[3], $key);
        $mem_in_bucket = function(dynamic $param) use ($H,$call2,$hkey,$key) {
          $param__0 = $param;
          for (;;) {
            if ($param__0) {
              $rest = $param__0[3];
              $c = $param__0[2];
              $hk = $param__0[1];
              if ($hk === $hkey) {
                $match = $call2($H[3], $c, $key);
                if (0 === $match) {return 1;}
                $param__0 = $rest;
                continue;
              }
              $param__0 = $rest;
              continue;
            }
            return 0;
          }
        };
        $AP = $key_index($h, $hkey);
        return $mem_in_bucket($caml_check_bound($h[2], $AP)[$AP + 1]);
      };
      $iter = function(dynamic $f, dynamic $h) use ($H,$call1,$call2,$caml_check_bound) {
        $do_bucket = function(dynamic $param) use ($H,$call1,$call2,$f) {
          $param__0 = $param;
          for (;;) {
            if ($param__0) {
              $rest = $param__0[3];
              $c = $param__0[2];
              $match = $call1($H[5], $c);
              $match__0 = $call1($H[4], $c);
              if ($match) {
                if ($match__0) {
                  $d = $match__0[1];
                  $k = $match[1];
                  $call2($f, $k, $d);
                  $switch__0 = 1;
                }
                else {$switch__0 = 0;}
              }
              else {$switch__0 = 0;}
              ;
              $param__0 = $rest;
              continue;
            }
            return 0;
          }
        };
        $d = $h[2];
        $AN = (int) ($d->count() - 1 + -1);
        $AM = 0;
        if (! ($AN < 0)) {
          $i = $AM;
          for (;;) {
            $do_bucket($caml_check_bound($d, $i)[$i + 1]);
            $AO = (int) ($i + 1);
            if ($AN !== $i) {$i = $AO;continue;}
            break;
          }
        }
        return 0;
      };
      $fold = function(dynamic $f, dynamic $h, dynamic $init) use ($H,$call1,$call3,$caml_check_bound) {
        $do_bucket = function(dynamic $b, dynamic $accu) use ($H,$call1,$call3,$f) {
          $b__0 = $b;
          $accu__0 = $accu;
          for (;;) {
            if ($b__0) {
              $rest = $b__0[3];
              $c = $b__0[2];
              $match = $call1($H[5], $c);
              $match__0 = $call1($H[4], $c);
              if ($match) {
                if ($match__0) {
                  $d = $match__0[1];
                  $k = $match[1];
                  $accu__1 = $call3($f, $k, $d, $accu__0);
                  $switch__0 = 1;
                }
                else {$switch__0 = 0;}
              }
              else {$switch__0 = 0;}
              if (! $switch__0) {$accu__1 = $accu__0;}
              $b__0 = $rest;
              $accu__0 = $accu__1;
              continue;
            }
            return $accu__0;
          }
        };
        $d = $h[2];
        $accu = Vector{0, $init};
        $AJ = (int) ($d->count() - 1 + -1);
        $AI = 0;
        if (! ($AJ < 0)) {
          $i = $AI;
          for (;;) {
            $AK = $accu[1];
            $accu[1] = $do_bucket($caml_check_bound($d, $i)[$i + 1], $AK);
            $AL = (int) ($i + 1);
            if ($AJ !== $i) {$i = $AL;continue;}
            break;
          }
        }
        return $accu[1];
      };
      $filter_map_inplace = function(dynamic $f, dynamic $h) use ($H,$call1,$call2,$call3,$caml_check_bound) {
        $do_bucket = new Ref();
        $do_bucket->contents = function(dynamic $param) use ($H,$call1,$call2,$call3,$do_bucket,$f) {
          $param__0 = $param;
          for (;;) {
            if ($param__0) {
              $rest = $param__0[3];
              $c = $param__0[2];
              $hk = $param__0[1];
              $match = $call1($H[5], $c);
              $match__0 = $call1($H[4], $c);
              if ($match) {
                if ($match__0) {
                  $d = $match__0[1];
                  $k = $match[1];
                  $match__1 = $call2($f, $k, $d);
                  if ($match__1) {
                    $new_d = $match__1[1];
                    $call3($H[6], $c, $k, $new_d);
                    return Vector{0, $hk, $c, $do_bucket->contents($rest)};
                  }
                  $param__0 = $rest;
                  continue;
                }
              }
              $param__0 = $rest;
              continue;
            }
            return 0;
          }
        };
        $d = $h[2];
        $AG = (int) ($d->count() - 1 + -1);
        $AF = 0;
        if (! ($AG < 0)) {
          $i = $AF;
          for (;;) {
            $d[$i + 1] =
              $do_bucket->contents($caml_check_bound($d, $i)[$i + 1]);
            $AH = (int) ($i + 1);
            if ($AG !== $i) {$i = $AH;continue;}
            break;
          }
        }
        return 0;
      };
      $length = function(dynamic $h) {return $h[1];};
      $bucket_length = function(dynamic $accu, dynamic $param) {
        $accu__0 = $accu;
        $param__0 = $param;
        for (;;) {
          if ($param__0) {
            $param__1 = $param__0[3];
            $accu__1 = (int) ($accu__0 + 1);
            $accu__0 = $accu__1;
            $param__0 = $param__1;
            continue;
          }
          return $accu__0;
        }
      };
      $stats = function(dynamic $h) use ($Array,$Pervasives,$bucket_length,$call2,$call3,$caml_check_bound,$caml_make_vect) {
        $Az = $h[2];
        $AA = 0;
        $AB = function(dynamic $m, dynamic $b) use ($Pervasives,$bucket_length,$call2) {
          $AE = $bucket_length(0, $b);
          return $call2($Pervasives[5], $m, $AE);
        };
        $mbl = $call3($Array[17], $AB, $AA, $Az);
        $histo = $caml_make_vect((int) ($mbl + 1), 0);
        $AC = $h[2];
        $AD = function(dynamic $b) use ($bucket_length,$caml_check_bound,$histo) {
          $l = $bucket_length(0, $b);
          $histo[$l + 1] = (int) ($caml_check_bound($histo, $l)[$l + 1] + 1);
          return 0;
        };
        $call2($Array[13], $AD, $AC);
        return Vector{0, $h[1], $h[2]->count() - 1, $mbl, $histo};
      };
      $bucket_length_alive = function(dynamic $accu, dynamic $param) use ($H,$call1) {
        $accu__0 = $accu;
        $param__0 = $param;
        for (;;) {
          if ($param__0) {
            $rest = $param__0[3];
            $c = $param__0[2];
            if ($call1($H[7], $c)) {
              $accu__1 = (int) ($accu__0 + 1);
              $accu__0 = $accu__1;
              $param__0 = $rest;
              continue;
            }
            $param__0 = $rest;
            continue;
          }
          return $accu__0;
        }
      };
      $stats_alive = function(dynamic $h) use ($Array,$Pervasives,$bucket_length_alive,$call2,$call3,$caml_check_bound,$caml_make_vect) {
        $size = Vector{0, 0};
        $At = $h[2];
        $Au = 0;
        $Av = function(dynamic $m, dynamic $b) use ($Pervasives,$bucket_length_alive,$call2) {
          $Ay = $bucket_length_alive(0, $b);
          return $call2($Pervasives[5], $m, $Ay);
        };
        $mbl = $call3($Array[17], $Av, $Au, $At);
        $histo = $caml_make_vect((int) ($mbl + 1), 0);
        $Aw = $h[2];
        $Ax = function(dynamic $b) use ($bucket_length_alive,$caml_check_bound,$histo,$size) {
          $l = $bucket_length_alive(0, $b);
          $size[1] = (int) ($size[1] + $l);
          $histo[$l + 1] = (int) ($caml_check_bound($histo, $l)[$l + 1] + 1);
          return 0;
        };
        $call2($Array[13], $Ax, $Aw);
        return Vector{0, $size[1], $h[2]->count() - 1, $mbl, $histo};
      };
      return Vector{
        0,
        $create,
        $clear,
        $reset,
        $copy,
        $add,
        $remove,
        $find,
        $find_opt,
        $find_all,
        $replace,
        $mem,
        $iter,
        $filter_map_inplace,
        $fold,
        $length,
        $stats,
        $clean,
        $stats_alive
      };
    };
    $obj_opt = function(dynamic $x) {return $x;};
    $create = function(dynamic $param) use ($Obj,$call1) {
      return $call1($Obj[26][1], 1);
    };
    $get_key = function(dynamic $t) use ($Obj,$call2,$obj_opt) {
      return $obj_opt($call2($Obj[26][3], $t, 0));
    };
    $get_key_copy = function(dynamic $t) use ($Obj,$call2,$obj_opt) {
      return $obj_opt($call2($Obj[26][4], $t, 0));
    };
    $set_key = function(dynamic $t, dynamic $k) use ($Obj,$call3) {
      return $call3($Obj[26][5], $t, 0, $k);
    };
    $unset_key = function(dynamic $t) use ($Obj,$call2) {
      return $call2($Obj[26][6], $t, 0);
    };
    $check_key = function(dynamic $t) use ($Obj,$call2) {
      return $call2($Obj[26][7], $t, 0);
    };
    $blit_key = function(dynamic $t1, dynamic $t2) use ($Obj,$call5) {
      return $call5($Obj[26][8], $t1, 0, $t2, 0, 1);
    };
    $get_data = function(dynamic $t) use ($Obj,$call1,$obj_opt) {
      return $obj_opt($call1($Obj[26][9], $t));
    };
    $get_data_copy = function(dynamic $t) use ($Obj,$call1,$obj_opt) {
      return $obj_opt($call1($Obj[26][10], $t));
    };
    $set_data = function(dynamic $t, dynamic $d) use ($Obj,$call2) {
      return $call2($Obj[26][11], $t, $d);
    };
    $unset_data = function(dynamic $t) use ($Obj,$call1) {
      return $call1($Obj[26][12], $t);
    };
    $check_data = function(dynamic $t) use ($Obj,$call1) {
      return $call1($Obj[26][13], $t);
    };
    $blit_data = function(dynamic $t1, dynamic $t2) use ($Obj,$call2) {
      return $call2($Obj[26][14], $t1, $t2);
    };
    $MakeSeeded__0 = function(dynamic $H) use ($MakeSeeded,$call2,$check_key,$create,$get_data,$get_key,$set_data,$set_key,$unset_data) {
      $create__0 = function(dynamic $k, dynamic $d) use ($create,$set_data,$set_key) {
        $c = $create(0);
        $set_data($c, $d);
        $set_key($c, $k);
        return $c;
      };
      $hash = $H[2];
      $equal = function(dynamic $c, dynamic $k) use ($H,$call2,$get_key) {
        $match = $get_key($c);
        if ($match) {
          $k__0 = $match[1];
          return $call2($H[1], $k, $k__0) ? 0 : (1);
        }
        return 2;
      };
      $set_key_data = function(dynamic $c, dynamic $k, dynamic $d) use ($set_data,$set_key,$unset_data) {
        $unset_data($c);
        $set_key($c, $k);
        return $set_data($c, $d);
      };
      return $MakeSeeded(
        Vector{
          0,
          $create__0,
          $hash,
          $equal,
          $get_data,
          $get_key,
          $set_key_data,
          $check_key
        }
      );
    };
    $Make = function(dynamic $H) use ($MakeSeeded__0,$call1,$call2,$z3) {
      $equal = $H[1];
      $hash = function(dynamic $seed, dynamic $x) use ($H,$call1) {
        return $call1($H[2], $x);
      };
      $include = $MakeSeeded__0(Vector{0, $equal, $hash});
      $clear = $include[2];
      $reset = $include[3];
      $copy = $include[4];
      $add = $include[5];
      $remove = $include[6];
      $find = $include[7];
      $find_opt = $include[8];
      $find_all = $include[9];
      $replace = $include[10];
      $mem = $include[11];
      $iter = $include[12];
      $filter_map_inplace = $include[13];
      $fold = $include[14];
      $length = $include[15];
      $stats = $include[16];
      $clean = $include[17];
      $stats_alive = $include[18];
      $As = $include[1];
      $create = function(dynamic $sz) use ($As,$call2,$z3) {
        return $call2($As, $z3, $sz);
      };
      return Vector{
        0,
        $create,
        $clear,
        $reset,
        $copy,
        $add,
        $remove,
        $find,
        $find_opt,
        $find_all,
        $replace,
        $mem,
        $iter,
        $filter_map_inplace,
        $fold,
        $length,
        $stats,
        $clean,
        $stats_alive
      };
    };
    $create__0 = function(dynamic $param) use ($Obj,$call1) {
      return $call1($Obj[26][1], 2);
    };
    $get_key1 = function(dynamic $t) use ($Obj,$call2,$obj_opt) {
      return $obj_opt($call2($Obj[26][3], $t, 0));
    };
    $get_key1_copy = function(dynamic $t) use ($Obj,$call2,$obj_opt) {
      return $obj_opt($call2($Obj[26][4], $t, 0));
    };
    $set_key1 = function(dynamic $t, dynamic $k) use ($Obj,$call3) {
      return $call3($Obj[26][5], $t, 0, $k);
    };
    $unset_key1 = function(dynamic $t) use ($Obj,$call2) {
      return $call2($Obj[26][6], $t, 0);
    };
    $check_key1 = function(dynamic $t) use ($Obj,$call2) {
      return $call2($Obj[26][7], $t, 0);
    };
    $get_key2 = function(dynamic $t) use ($Obj,$call2,$obj_opt) {
      return $obj_opt($call2($Obj[26][3], $t, 1));
    };
    $get_key2_copy = function(dynamic $t) use ($Obj,$call2,$obj_opt) {
      return $obj_opt($call2($Obj[26][4], $t, 1));
    };
    $set_key2 = function(dynamic $t, dynamic $k) use ($Obj,$call3) {
      return $call3($Obj[26][5], $t, 1, $k);
    };
    $unset_key2 = function(dynamic $t) use ($Obj,$call2) {
      return $call2($Obj[26][6], $t, 1);
    };
    $check_key2 = function(dynamic $t) use ($Obj,$call2) {
      return $call2($Obj[26][7], $t, 1);
    };
    $blit_key1 = function(dynamic $t1, dynamic $t2) use ($Obj,$call5) {
      return $call5($Obj[26][8], $t1, 0, $t2, 0, 1);
    };
    $blit_key2 = function(dynamic $t1, dynamic $t2) use ($Obj,$call5) {
      return $call5($Obj[26][8], $t1, 1, $t2, 1, 1);
    };
    $blit_key12 = function(dynamic $t1, dynamic $t2) use ($Obj,$call5) {
      return $call5($Obj[26][8], $t1, 0, $t2, 0, 2);
    };
    $get_data__0 = function(dynamic $t) use ($Obj,$call1,$obj_opt) {
      return $obj_opt($call1($Obj[26][9], $t));
    };
    $get_data_copy__0 = function(dynamic $t) use ($Obj,$call1,$obj_opt) {
      return $obj_opt($call1($Obj[26][10], $t));
    };
    $set_data__0 = function(dynamic $t, dynamic $d) use ($Obj,$call2) {
      return $call2($Obj[26][11], $t, $d);
    };
    $unset_data__0 = function(dynamic $t) use ($Obj,$call1) {
      return $call1($Obj[26][12], $t);
    };
    $check_data__0 = function(dynamic $t) use ($Obj,$call1) {
      return $call1($Obj[26][13], $t);
    };
    $blit_data__0 = function(dynamic $t1, dynamic $t2) use ($Obj,$call2) {
      return $call2($Obj[26][14], $t1, $t2);
    };
    $MakeSeeded__1 = function(dynamic $H1, dynamic $H2) use ($MakeSeeded,$call2,$check_key1,$check_key2,$create__0,$get_data__0,$get_key1,$get_key2,$set_data__0,$set_key1,$set_key2,$unset_data__0) {
      $create = function(dynamic $param, dynamic $d) use ($create__0,$set_data__0,$set_key1,$set_key2) {
        $k2 = $param[2];
        $k1 = $param[1];
        $c = $create__0(0);
        $set_data__0($c, $d);
        $set_key1($c, $k1);
        $set_key2($c, $k2);
        return $c;
      };
      $hash = function(dynamic $seed, dynamic $param) use ($H1,$H2,$call2) {
        $k2 = $param[2];
        $k1 = $param[1];
        $Ar = (int) ($call2($H2[2], $seed, $k2) * 65599);
        return (int) ($call2($H1[2], $seed, $k1) + $Ar);
      };
      $equal = function(dynamic $c, dynamic $param) use ($H1,$H2,$call2,$get_key1,$get_key2) {
        $k2 = $param[2];
        $k1 = $param[1];
        $match = $get_key1($c);
        $match__0 = $get_key2($c);
        if ($match) {
          if ($match__0) {
            $k2__0 = $match__0[1];
            $k1__0 = $match[1];
            if ($call2($H1[1], $k1, $k1__0)) {
              if ($call2($H2[1], $k2, $k2__0)) {return 0;}
            }
            return 1;
          }
        }
        return 2;
      };
      $get_key = function(dynamic $c) use ($get_key1,$get_key2) {
        $match = $get_key1($c);
        $match__0 = $get_key2($c);
        if ($match) {
          if ($match__0) {
            $k2 = $match__0[1];
            $k1 = $match[1];
            return Vector{0, Vector{0, $k1, $k2}};
          }
        }
        return 0;
      };
      $set_key_data = function(dynamic $c, dynamic $param, dynamic $d) use ($set_data__0,$set_key1,$set_key2,$unset_data__0) {
        $k2 = $param[2];
        $k1 = $param[1];
        $unset_data__0($c);
        $set_key1($c, $k1);
        $set_key2($c, $k2);
        return $set_data__0($c, $d);
      };
      $check_key = function(dynamic $c) use ($check_key1,$check_key2) {
        $Aq = $check_key1($c);
        return $Aq ? $check_key2($c) : ($Aq);
      };
      return $MakeSeeded(
        Vector{
          0,
          $create,
          $hash,
          $equal,
          $get_data__0,
          $get_key,
          $set_key_data,
          $check_key
        }
      );
    };
    $Make__0 = function(dynamic $H1, dynamic $H2) use ($MakeSeeded__1,$call1,$call2,$z4) {
      $equal = $H2[1];
      $hash = function(dynamic $seed, dynamic $x) use ($H2,$call1) {
        return $call1($H2[2], $x);
      };
      $equal__0 = $H1[1];
      $Am = Vector{0, $equal, $hash};
      $hash__0 = function(dynamic $seed, dynamic $x) use ($H1,$call1) {
        return $call1($H1[2], $x);
      };
      $An = Vector{0, $equal__0, $hash__0};
      $include = (function(dynamic $Ap) use ($An,$MakeSeeded__1) {
         return $MakeSeeded__1($An, $Ap);
       })($Am);
      $clear = $include[2];
      $reset = $include[3];
      $copy = $include[4];
      $add = $include[5];
      $remove = $include[6];
      $find = $include[7];
      $find_opt = $include[8];
      $find_all = $include[9];
      $replace = $include[10];
      $mem = $include[11];
      $iter = $include[12];
      $filter_map_inplace = $include[13];
      $fold = $include[14];
      $length = $include[15];
      $stats = $include[16];
      $clean = $include[17];
      $stats_alive = $include[18];
      $Ao = $include[1];
      $create = function(dynamic $sz) use ($Ao,$call2,$z4) {
        return $call2($Ao, $z4, $sz);
      };
      return Vector{
        0,
        $create,
        $clear,
        $reset,
        $copy,
        $add,
        $remove,
        $find,
        $find_opt,
        $find_all,
        $replace,
        $mem,
        $iter,
        $filter_map_inplace,
        $fold,
        $length,
        $stats,
        $clean,
        $stats_alive
      };
    };
    $create__1 = function(dynamic $n) use ($Obj,$call1) {
      return $call1($Obj[26][1], $n);
    };
    $length = function(dynamic $k) use ($Obj,$call1) {
      return $call1($Obj[26][2], $k);
    };
    $get_key__0 = function(dynamic $t, dynamic $n) use ($Obj,$call2,$obj_opt) {
      return $obj_opt($call2($Obj[26][3], $t, $n));
    };
    $get_key_copy__0 = function(dynamic $t, dynamic $n) use ($Obj,$call2,$obj_opt) {
      return $obj_opt($call2($Obj[26][4], $t, $n));
    };
    $set_key__0 = function(dynamic $t, dynamic $n, dynamic $k) use ($Obj,$call3) {
      return $call3($Obj[26][5], $t, $n, $k);
    };
    $unset_key__0 = function(dynamic $t, dynamic $n) use ($Obj,$call2) {
      return $call2($Obj[26][6], $t, $n);
    };
    $check_key__0 = function(dynamic $t, dynamic $n) use ($Obj,$call2) {
      return $call2($Obj[26][7], $t, $n);
    };
    $blit_key__0 = function
    (dynamic $t1, dynamic $o1, dynamic $t2, dynamic $o2, dynamic $l) use ($Obj,$call5) {
      return $call5($Obj[26][8], $t1, $o1, $t2, $o2, $l);
    };
    $get_data__1 = function(dynamic $t) use ($Obj,$call1,$obj_opt) {
      return $obj_opt($call1($Obj[26][9], $t));
    };
    $get_data_copy__1 = function(dynamic $t) use ($Obj,$call1,$obj_opt) {
      return $obj_opt($call1($Obj[26][10], $t));
    };
    $set_data__1 = function(dynamic $t, dynamic $d) use ($Obj,$call2) {
      return $call2($Obj[26][11], $t, $d);
    };
    $unset_data__1 = function(dynamic $t) use ($Obj,$call1) {
      return $call1($Obj[26][12], $t);
    };
    $check_data__1 = function(dynamic $t) use ($Obj,$call1) {
      return $call1($Obj[26][13], $t);
    };
    $blit_data__1 = function(dynamic $t1, dynamic $t2) use ($Obj,$call2) {
      return $call2($Obj[26][14], $t1, $t2);
    };
    $MakeSeeded__2 = function(dynamic $H) use ($MakeSeeded,$call2,$caml_check_bound,$caml_make_vect,$check_key__0,$create__1,$get_data__1,$get_key__0,$length,$set_data__1,$set_key__0,$unset_data__1) {
      $create = function(dynamic $k, dynamic $d) use ($caml_check_bound,$create__1,$set_data__1,$set_key__0) {
        $c = $create__1($k->count() - 1);
        $set_data__1($c, $d);
        $Ak = (int) ($k->count() - 1 + -1);
        $Aj = 0;
        if (! ($Ak < 0)) {
          $i = $Aj;
          for (;;) {
            $set_key__0($c, $i, $caml_check_bound($k, $i)[$i + 1]);
            $Al = (int) ($i + 1);
            if ($Ak !== $i) {$i = $Al;continue;}
            break;
          }
        }
        return $c;
      };
      $hash = function(dynamic $seed, dynamic $k) use ($H,$call2,$caml_check_bound) {
        $h = Vector{0, 0};
        $Af = (int) ($k->count() - 1 + -1);
        $Ae = 0;
        if (! ($Af < 0)) {
          $i = $Ae;
          for (;;) {
            $Ag = $h[1];
            $Ah = $caml_check_bound($k, $i)[$i + 1];
            $h[1] = (int) ((int) ($call2($H[2], $seed, $Ah) * 65599) + $Ag);
            $Ai = (int) ($i + 1);
            if ($Af !== $i) {$i = $Ai;continue;}
            break;
          }
        }
        return $h[1];
      };
      $equal = function(dynamic $c, dynamic $k) use ($H,$call2,$caml_check_bound,$get_key__0,$length) {
        $len = $k->count() - 1;
        $len__0 = $length($c);
        if ($len !== $len__0) {return 1;}
        $equal_array = function(dynamic $k, dynamic $c, dynamic $i) use ($H,$call2,$caml_check_bound,$get_key__0) {
          $i__0 = $i;
          for (;;) {
            if (0 <= $i__0) {
              $match = $get_key__0($c, $i__0);
              if ($match) {
                $ki = $match[1];
                $Ad = $caml_check_bound($k, $i__0)[$i__0 + 1];
                if ($call2($H[1], $Ad, $ki)) {
                  $i__1 = (int) ($i__0 + -1);
                  $i__0 = $i__1;
                  continue;
                }
                return 1;
              }
              return 2;
            }
            return 0;
          }
        };
        return $equal_array($k, $c, (int) ($len + -1));
      };
      $get_key = function(dynamic $c) use ($caml_check_bound,$caml_make_vect,$get_key__0,$length) {
        $len = $length($c);
        if (0 === $len) {return Vector{0, Vector{0}};}
        $match = $get_key__0($c, 0);
        if ($match) {
          $k0 = $match[1];
          $fill = function(dynamic $a, dynamic $i) use ($c,$caml_check_bound,$get_key__0) {
            $i__0 = $i;
            for (;;) {
              if (1 <= $i__0) {
                $match = $get_key__0($c, $i__0);
                if ($match) {
                  $ki = $match[1];
                  $caml_check_bound($a, $i__0)[$i__0 + 1] = $ki;
                  $i__1 = (int) ($i__0 + -1);
                  $i__0 = $i__1;
                  continue;
                }
                return 0;
              }
              return Vector{0, $a};
            }
          };
          $a = $caml_make_vect($len, $k0);
          return $fill($a, (int) ($len + -1));
        }
        return 0;
      };
      $set_key_data = function(dynamic $c, dynamic $k, dynamic $d) use ($caml_check_bound,$set_data__1,$set_key__0,$unset_data__1) {
        $unset_data__1($c);
        $Ab = (int) ($k->count() - 1 + -1);
        $Aa = 0;
        if (! ($Ab < 0)) {
          $i = $Aa;
          for (;;) {
            $set_key__0($c, $i, $caml_check_bound($k, $i)[$i + 1]);
            $Ac = (int) ($i + 1);
            if ($Ab !== $i) {$i = $Ac;continue;}
            break;
          }
        }
        return $set_data__1($c, $d);
      };
      $check_key = function(dynamic $c) use ($check_key__0,$length) {
        $check = function(dynamic $c, dynamic $i) use ($check_key__0) {
          $i__0 = $i;
          for (;;) {
            $z8 = $i__0 < 0 ? 1 : (0);
            if ($z8) {
              $z9 = $z8;
            }
            else {
              $z_ = $check_key__0($c, $i__0);
              if ($z_) {$i__1 = (int) ($i__0 + -1);$i__0 = $i__1;continue;}
              $z9 = $z_;
            }
            return $z9;
          }
        };
        return $check($c, (int) ($length($c) + -1));
      };
      return $MakeSeeded(
        Vector{
          0,
          $create,
          $hash,
          $equal,
          $get_data__1,
          $get_key,
          $set_key_data,
          $check_key
        }
      );
    };
    $Make__1 = function(dynamic $H) use ($MakeSeeded__2,$call1,$call2,$z5) {
      $equal = $H[1];
      $hash = function(dynamic $seed, dynamic $x) use ($H,$call1) {
        return $call1($H[2], $x);
      };
      $include = $MakeSeeded__2(Vector{0, $equal, $hash});
      $clear = $include[2];
      $reset = $include[3];
      $copy = $include[4];
      $add = $include[5];
      $remove = $include[6];
      $find = $include[7];
      $find_opt = $include[8];
      $find_all = $include[9];
      $replace = $include[10];
      $mem = $include[11];
      $iter = $include[12];
      $filter_map_inplace = $include[13];
      $fold = $include[14];
      $length = $include[15];
      $stats = $include[16];
      $clean = $include[17];
      $stats_alive = $include[18];
      $z7 = $include[1];
      $create = function(dynamic $sz) use ($call2,$z5,$z7) {
        return $call2($z7, $z5, $sz);
      };
      return Vector{
        0,
        $create,
        $clear,
        $reset,
        $copy,
        $add,
        $remove,
        $find,
        $find_opt,
        $find_all,
        $replace,
        $mem,
        $iter,
        $filter_map_inplace,
        $fold,
        $length,
        $stats,
        $clean,
        $stats_alive
      };
    };
    $Ephemeron = Vector{
      0,
      Vector{
        0,
        $create,
        $get_key,
        $get_key_copy,
        $set_key,
        $unset_key,
        $check_key,
        $blit_key,
        $get_data,
        $get_data_copy,
        $set_data,
        $unset_data,
        $check_data,
        $blit_data,
        $Make,
        $MakeSeeded__0
      },
      Vector{
        0,
        $create__0,
        $get_key1,
        $get_key1_copy,
        $set_key1,
        $unset_key1,
        $check_key1,
        $get_key2,
        $get_key2_copy,
        $set_key2,
        $unset_key2,
        $check_key2,
        $blit_key1,
        $blit_key2,
        $blit_key12,
        $get_data__0,
        $get_data_copy__0,
        $set_data__0,
        $unset_data__0,
        $check_data__0,
        $blit_data__0,
        $Make__0,
        $MakeSeeded__1
      },
      Vector{
        0,
        $create__1,
        $get_key__0,
        $get_key_copy__0,
        $set_key__0,
        $unset_key__0,
        $check_key__0,
        $blit_key__0,
        $get_data__1,
        $get_data_copy__1,
        $set_data__1,
        $unset_data__1,
        $check_data__1,
        $blit_data__1,
        $Make__1,
        $MakeSeeded__2
      },
      Vector{
        0,
        function(dynamic $z6) use ($MakeSeeded) {
          return $MakeSeeded(
            Vector{0, $z6[3], $z6[1], $z6[2], $z6[5], $z6[4], $z6[6], $z6[7]}
          );
        }
      }
    };
    
    $runtime["caml_register_global"](11, $Ephemeron, "Ephemeron");

  }
}