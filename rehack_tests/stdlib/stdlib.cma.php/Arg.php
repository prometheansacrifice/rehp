<?hh
// Copyright 2004-present Facebook. All Rights Reserved.

/**
 * Arg.php
 */

namespace Rehack;

final class Arg {
  <<__Memoize>>
  public static function get() {
    $global_object = \Rehack\GlobalObject::get();
    $runtime = \Rehack\Runtime::get();
    /*
     * Soon, these will replace the `global_data->ModuleName`
     * pattern in the load() function.
     */
    $Array_ = Array_::get();
    $Buffer = Buffer::get();
    $List_ = List_::get();
    $Pervasives = Pervasives::get();
    $Printf = Printf::get();
    $String_ = String_::get();
    $Sys = Sys::get();
    $Invalid_argument = Invalid_argument::get();
    $Failure = Failure::get();
    $Not_found = Not_found::get();
    $End_of_file = End_of_file::get();
    Arg::load($global_object);
    $memoized = $runtime->caml_get_global_data()->Arg;
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
    $call4 = $runtime["caml_call4"];
    $call5 = $runtime["caml_call5"];
    $call6 = $runtime["caml_call6"];
    $caml_check_bound = $runtime["caml_check_bound"];
    $caml_equal = $runtime["caml_equal"];
    $caml_fresh_oo_id = $runtime["caml_fresh_oo_id"];
    $caml_ml_string_length = $runtime["caml_ml_string_length"];
    $string = $runtime["caml_new_string"];
    $caml_string_get = $runtime["caml_string_get"];
    $caml_string_notequal = $runtime["caml_string_notequal"];
    $caml_wrap_exception = $runtime["caml_wrap_exception"];
    $global_data = $runtime["caml_get_global_data"]();
    $cst__6 = $string("");
    $cst__7 = $string("\n");
    $cst_a_boolean = $string("a boolean");
    $cst_an_integer = $string("an integer");
    $cst_an_integer__0 = $string("an integer");
    $cst_a_float = $string("a float");
    $cst_a_float__0 = $string("a float");
    $cst__3 = $string("");
    $cst__4 = $string(" ");
    $cst__5 = $string("");
    $cst_one_of = $string("one of: ");
    $cst_Arg_Expand_is_is_only_allowed_with_Arg_parse_and_expand_argv_dynamic = $string(
      "Arg.Expand is is only allowed with Arg.parse_and_expand_argv_dynamic"
    );
    $cst_no_argument = $string("no argument");
    $cst__2 = $string("(?)");
    $cst_help__3 = $string("--help");
    $cst_help__4 = $string("-help");
    $cst_help__2 = $string("-help");
    $cst_Display_this_list_of_options = $string(
      " Display this list of options"
    );
    $cst_help = $string("-help");
    $cst_help__1 = $string("--help");
    $cst_Display_this_list_of_options__0 = $string(
      " Display this list of options"
    );
    $cst_help__0 = $string("--help");
    $cst = $string("}");
    $cst__0 = $string("|");
    $cst__1 = $string("{");
    $cst_none = $string("<none>");
    $cst_Arg_Bad = $string("Arg.Bad");
    $cst_Arg_Help = $string("Arg.Help");
    $cst_Arg_Stop = $string("Arg.Stop");
    $Not_found = $global_data["Not_found"];
    $Printf = $global_data["Printf"];
    $Pervasives = $global_data["Pervasives"];
    $Array = $global_data["Array_"];
    $Buffer = $global_data["Buffer"];
    $End_of_file = $global_data["End_of_file"];
    $List = $global_data["List_"];
    $String = $global_data["String_"];
    $Sys = $global_data["Sys"];
    $Invalid_argument = $global_data["Invalid_argument"];
    $Failure = $global_data["Failure"];
    $nx = Vector{0, Vector{2, 0, Vector{0, 0}}, $string("%s%c")};
    $nr = Vector{0, Vector{2, 0, 0}, $string("%s")};
    $ns = Vector{0, Vector{2, 0, 0}, $string("%s")};
    $np = Vector{0, Vector{2, 0, 0}, $string("%s")};
    $nq = Vector{0, Vector{2, 0, 0}, $string("%s")};
    $nn = Vector{0, Vector{2, 0, 0}, $string("%s")};
    $no = Vector{0, Vector{2, 0, 0}, $string("%s")};
    $nh = Vector{
      0,
      Vector{
        2,
        0,
        Vector{
          11,
          $string(": unknown option '"),
          Vector{2, 0, Vector{11, $string("'.\n"), 0}}
        }
      },
      $string("%s: unknown option '%s'.\n")
    };
    $nk = Vector{
      0,
      Vector{
        2,
        0,
        Vector{
          11,
          $string(": wrong argument '"),
          Vector{
            2,
            0,
            Vector{
              11,
              $string("'; option '"),
              Vector{
                2,
                0,
                Vector{
                  11,
                  $string("' expects "),
                  Vector{2, 0, Vector{11, $string(".\n"), 0}}
                }
              }
            }
          }
        }
      },
      $string("%s: wrong argument '%s'; option '%s' expects %s.\n")
    };
    $nl = Vector{
      0,
      Vector{
        2,
        0,
        Vector{
          11,
          $string(": option '"),
          Vector{2, 0, Vector{11, $string("' needs an argument.\n"), 0}}
        }
      },
      $string("%s: option '%s' needs an argument.\n")
    };
    $nm = Vector{
      0,
      Vector{
        2,
        0,
        Vector{11, $string(": "), Vector{2, 0, Vector{11, $string(".\n"), 0}}}
      },
      $string("%s: %s.\n")
    };
    $ni = Vector{0, $string("-help")};
    $nj = Vector{0, $string("--help")};
    $ng = Vector{0, Vector{2, 0, 0}, $string("%s")};
    $nf = Vector{0, Vector{2, 0, Vector{12, 10, 0}}, $string("%s\n")};
    $ne = Vector{0, $string("-help")};
    $nc = Vector{
      0,
      Vector{
        11,
        $string("  "),
        Vector{2, 0, Vector{12, 32, Vector{2, 0, Vector{12, 10, 0}}}}
      },
      $string("  %s %s\n")
    };
    $nd = Vector{
      0,
      Vector{
        11,
        $string("  "),
        Vector{
          2,
          0,
          Vector{12, 32, Vector{2, 0, Vector{2, 0, Vector{12, 10, 0}}}}
        }
      },
      $string("  %s %s%s\n")
    };
    $Bad = Vector{248, $cst_Arg_Bad, $caml_fresh_oo_id(0)};
    $Help = Vector{248, $cst_Arg_Help, $caml_fresh_oo_id(0)};
    $Stop = Vector{248, $cst_Arg_Stop, $caml_fresh_oo_id(0)};
    $assoc3 = function(dynamic $x, dynamic $l) use ($Not_found,$caml_equal,$runtime) {
      $l__0 = $l;
      for (;;) {
        if ($l__0) {
          $t = $l__0[2];
          $match = $l__0[1];
          $y2 = $match[2];
          $y1 = $match[1];
          if ($caml_equal($y1, $x)) {return $y2;}
          $l__0 = $t;
          continue;
        }
        throw $runtime["caml_wrap_thrown_exception"]($Not_found) as \Throwable;
      }
    };
    $split = function(dynamic $s) use ($String,$call2,$call3,$caml_ml_string_length) {
      $i = $call2($String[14], $s, 61);
      $len = $caml_ml_string_length($s);
      $ox = $call3(
        $String[4],
        $s,
        (int)
        ($i + 1),
        (int)
        ($len - (int) ($i + 1))
      );
      return Vector{0, $call3($String[4], $s, 0, $i), $ox};
    };
    $make_symlist = function
    (dynamic $prefix, dynamic $sep, dynamic $suffix, dynamic $l) use ($List,$Pervasives,$call2,$call3,$cst_none) {
      if ($l) {
        $t = $l[2];
        $h = $l[1];
        $ot = $call2($Pervasives[16], $prefix, $h);
        $ou = function(dynamic $x, dynamic $y) use ($Pervasives,$call2,$sep) {
          $ow = $call2($Pervasives[16], $sep, $y);
          return $call2($Pervasives[16], $x, $ow);
        };
        $ov = $call3($List[20], $ou, $ot, $t);
        return $call2($Pervasives[16], $ov, $suffix);
      }
      return $cst_none;
    };
    $print_spec = function(dynamic $buf, dynamic $param) use ($Printf,$call4,$call5,$caml_ml_string_length,$cst,$cst__0,$cst__1,$make_symlist,$nc,$nd) {
      $doc = $param[3];
      $spec = $param[2];
      $key = $param[1];
      $or = 0 < $caml_ml_string_length($doc) ? 1 : (0);
      if ($or) {
        if (11 === $spec[0]) {
          $l = $spec[1];
          $os = $make_symlist($cst__1, $cst__0, $cst, $l);
          return $call5($Printf[5], $buf, $nd, $key, $os, $doc);
        }
        return $call4($Printf[5], $buf, $nc, $key, $doc);
      }
      return $or;
    };
    $help_action = function(dynamic $param) use ($Stop,$ne,$runtime) {
      throw $runtime["caml_wrap_thrown_exception"](Vector{0, $Stop, $ne}) as \Throwable;
    };
    $add_help = function(dynamic $speclist) use ($Not_found,$Pervasives,$assoc3,$call2,$caml_wrap_exception,$cst_Display_this_list_of_options,$cst_Display_this_list_of_options__0,$cst_help,$cst_help__0,$cst_help__1,$cst_help__2,$help_action,$runtime) {
      try {$assoc3($cst_help__2, $speclist);$oo = 0;$ok = $oo;}
      catch(\Throwable $oq) {
        $oq = $caml_wrap_exception($oq);
        if ($oq !== $Not_found) {
          throw $runtime["caml_wrap_thrown_exception_reraise"]($oq) as \Throwable;
        }
        $oj = Vector{
          0,
          Vector{
            0,
            $cst_help,
            Vector{0, $help_action},
            $cst_Display_this_list_of_options
          },
          0
        };
        $ok = $oj;
      }
      try {$assoc3($cst_help__1, $speclist);$on = 0;$add2 = $on;}
      catch(\Throwable $op) {
        $op = $caml_wrap_exception($op);
        if ($op !== $Not_found) {
          throw $runtime["caml_wrap_thrown_exception_reraise"]($op) as \Throwable;
        }
        $ol = Vector{
          0,
          Vector{
            0,
            $cst_help__0,
            Vector{0, $help_action},
            $cst_Display_this_list_of_options__0
          },
          0
        };
        $add2 = $ol;
      }
      $om = $call2($Pervasives[25], $ok, $add2);
      return $call2($Pervasives[25], $speclist, $om);
    };
    $usage_b = function(dynamic $buf, dynamic $speclist, dynamic $errmsg) use ($List,$Printf,$add_help,$call2,$call3,$nf,$print_spec) {
      $call3($Printf[5], $buf, $nf, $errmsg);
      $og = $add_help($speclist);
      $oh = function(dynamic $oi) use ($buf,$print_spec) {
        return $print_spec($buf, $oi);
      };
      return $call2($List[15], $oh, $og);
    };
    $usage_string = function(dynamic $speclist, dynamic $errmsg) use ($Buffer,$call1,$usage_b) {
      $b = $call1($Buffer[1], 200);
      $usage_b($b, $speclist, $errmsg);
      return $call1($Buffer[2], $b);
    };
    $usage = function(dynamic $speclist, dynamic $errmsg) use ($Printf,$call2,$ng,$usage_string) {
      $of = $usage_string($speclist, $errmsg);
      return $call2($Printf[3], $ng, $of);
    };
    $current = Vector{0, 0};
    $bool_of_string_opt = function(dynamic $x) use ($Invalid_argument,$Pervasives,$call1,$caml_wrap_exception,$runtime) {
      try {$od = Vector{0, $call1($Pervasives[19], $x)};return $od;}
      catch(\Throwable $oe) {
        $oe = $caml_wrap_exception($oe);
        if ($oe[1] === $Invalid_argument) {return 0;}
        throw $runtime["caml_wrap_thrown_exception_reraise"]($oe) as \Throwable;
      }
    };
    $int_of_string_opt = function(dynamic $x) use ($Failure,$caml_wrap_exception,$runtime) {
      try {$ob = Vector{0, $runtime["caml_int_of_string"]($x)};return $ob;}
      catch(\Throwable $oc) {
        $oc = $caml_wrap_exception($oc);
        if ($oc[1] === $Failure) {return 0;}
        throw $runtime["caml_wrap_thrown_exception_reraise"]($oc) as \Throwable;
      }
    };
    $float_of_string_opt = function(dynamic $x) use ($Failure,$caml_wrap_exception,$runtime) {
      try {$n_ = Vector{0, $runtime["caml_float_of_string"]($x)};return $n_;}
      catch(\Throwable $oa) {
        $oa = $caml_wrap_exception($oa);
        if ($oa[1] === $Failure) {return 0;}
        throw $runtime["caml_wrap_thrown_exception_reraise"]($oa) as \Throwable;
      }
    };
    $parse_and_expand_argv_dynamic_aux = function
    (dynamic $allow_expand, dynamic $current, dynamic $argv, dynamic $speclist, dynamic $anonfun, dynamic $errmsg) use ($Array,$Bad,$Buffer,$Help,$Invalid_argument,$List,$Not_found,$Pervasives,$Printf,$Stop,$assoc3,$bool_of_string_opt,$call1,$call2,$call3,$call4,$call6,$caml_check_bound,$caml_equal,$caml_ml_string_length,$caml_string_get,$caml_string_notequal,$caml_wrap_exception,$cst_Arg_Expand_is_is_only_allowed_with_Arg_parse_and_expand_argv_dynamic,$cst__2,$cst__3,$cst__4,$cst__5,$cst_a_boolean,$cst_a_float,$cst_a_float__0,$cst_an_integer,$cst_an_integer__0,$cst_help__3,$cst_help__4,$cst_no_argument,$cst_one_of,$float_of_string_opt,$int_of_string_opt,$make_symlist,$nh,$ni,$nj,$nk,$nl,$nm,$runtime,$split,$usage_b) {
      $initpos = $current[1];
      $convert_error = function(dynamic $error) use ($Bad,$Buffer,$Help,$Printf,$argv,$call1,$call4,$call6,$caml_check_bound,$caml_equal,$caml_string_notequal,$cst__2,$cst_help__3,$cst_help__4,$errmsg,$initpos,$nh,$ni,$nj,$nk,$nl,$nm,$speclist,$usage_b) {
        $b = $call1($Buffer[1], 200);
        $progname = $initpos < $argv[1]->count() - 1
          ? $caml_check_bound($argv[1], $initpos)[$initpos + 1]
          : ($cst__2);
        switch($error[0]) {
          // FALLTHROUGH
          case 0:
            $n9 = $error[1];
            if ($caml_string_notequal($n9, $cst_help__3)) {
              if ($caml_string_notequal($n9, $cst_help__4)) {$call4($Printf[5], $b, $nh, $progname, $n9);}
            }
            break;
          // FALLTHROUGH
          case 1:
            $expected = $error[3];
            $arg = $error[2];
            $opt = $error[1];
            $call6($Printf[5], $b, $nk, $progname, $arg, $opt, $expected);
            break;
          // FALLTHROUGH
          case 2:
            $s = $error[1];
            $call4($Printf[5], $b, $nl, $progname, $s);
            break;
          // FALLTHROUGH
          default:
            $s__0 = $error[1];
            $call4($Printf[5], $b, $nm, $progname, $s__0);
          }
        $usage_b($b, $speclist[1], $errmsg);
        if (! $caml_equal($error, $ni)) {
          if (! $caml_equal($error, $nj)) {
            return Vector{0, $Bad, $call1($Buffer[2], $b)};
          }
        }
        return Vector{0, $Help, $call1($Buffer[2], $b)};
      };
      $current[1] += 1;
      for (;;) {
        if ($current[1] < $argv[1]->count() - 1) {
          try {
            $n1 = $current[1];
            $s = $caml_check_bound($argv[1], $n1)[$n1 + 1];
            if (1 <= $caml_ml_string_length($s)) {
              if (45 === $caml_string_get($s, 0)) {
                try {
                  $follow__1 = 0;
                  $n3 = $assoc3($s, $speclist[1]);
                  $action = $n3;
                  $follow__0 = $follow__1;
                }
                catch(\Throwable $n7) {
                  $n7 = $caml_wrap_exception($n7);
                  if ($n7 !== $Not_found) {
                    throw $runtime["caml_wrap_thrown_exception_reraise"]($n7) as \Throwable;
                  }
                  try {
                    $match = $split($s);
                    $arg = $match[2];
                    $keyword = $match[1];
                    $follow = Vector{0, $arg};
                    $n2 = $assoc3($keyword, $speclist[1]);
                  }
                  catch(\Throwable $n8) {
                    $n8 = $caml_wrap_exception($n8);
                    if ($n8 === $Not_found) {
                      throw $runtime["caml_wrap_thrown_exception"](Vector{0, $Stop, Vector{0, $s}}) as \Throwable;
                    }
                    throw $runtime["caml_wrap_thrown_exception_reraise"]($n8) as \Throwable;
                  }
                  $action = $n2;
                  $follow__0 = $follow;
                }
                $no_arg__0 = function(dynamic $s, dynamic $follow) use ($Stop,$cst_no_argument,$runtime) {
                  $no_arg = function(dynamic $param) use ($Stop,$cst_no_argument,$follow,$runtime,$s) {
                    if ($follow) {
                      $arg = $follow[1];
                      throw $runtime["caml_wrap_thrown_exception"](
                              Vector{0, $Stop, Vector{1, $s, $arg, $cst_no_argument}}
                            ) as \Throwable;
                    }
                    return 0;
                  };
                  return $no_arg;
                };
                $no_arg = $no_arg__0($s, $follow__0);
                $get_arg__0 = function(dynamic $s, dynamic $follow) use ($Stop,$argv,$caml_check_bound,$current,$runtime) {
                  $get_arg = function(dynamic $param) use ($Stop,$argv,$caml_check_bound,$current,$follow,$runtime,$s) {
                    if ($follow) {$arg = $follow[1];return $arg;}
                    if ((int) ($current[1] + 1) < $argv[1]->count() - 1) {
                      $n6 = (int) ($current[1] + 1);
                      return $caml_check_bound($argv[1], $n6)[$n6 + 1];
                    }
                    throw $runtime["caml_wrap_thrown_exception"](Vector{0, $Stop, Vector{2, $s}}) as \Throwable;
                  };
                  return $get_arg;
                };
                $get_arg = $get_arg__0($s, $follow__0);
                $consume_arg__0 = function(dynamic $follow) use ($current) {
                  $consume_arg = function(dynamic $param) use ($current,$follow) {
                    if ($follow) {return 0;}
                    $current[1] += 1;
                    return 0;
                  };
                  return $consume_arg;
                };
                $consume_arg = $consume_arg__0($follow__0);
                $treat_action__0 = function
                (dynamic $s, dynamic $no_arg, dynamic $get_arg, dynamic $consume_arg) use ($Array,$Invalid_argument,$List,$Pervasives,$Stop,$allow_expand,$argv,$bool_of_string_opt,$call1,$call2,$call3,$caml_check_bound,$cst_Arg_Expand_is_is_only_allowed_with_Arg_parse_and_expand_argv_dynamic,$cst__3,$cst__4,$cst__5,$cst_a_boolean,$cst_a_float,$cst_a_float__0,$cst_an_integer,$cst_an_integer__0,$cst_one_of,$current,$float_of_string_opt,$int_of_string_opt,$make_symlist,$runtime) {
                  $treat_action = new Ref();
                  $treat_action->contents = function(dynamic $param) use ($Array,$Invalid_argument,$List,$Pervasives,$Stop,$allow_expand,$argv,$bool_of_string_opt,$call1,$call2,$call3,$caml_check_bound,$consume_arg,$cst_Arg_Expand_is_is_only_allowed_with_Arg_parse_and_expand_argv_dynamic,$cst__3,$cst__4,$cst__5,$cst_a_boolean,$cst_a_float,$cst_a_float__0,$cst_an_integer,$cst_an_integer__0,$cst_one_of,$current,$float_of_string_opt,$get_arg,$int_of_string_opt,$make_symlist,$no_arg,$runtime,$s,$treat_action) {
                    switch($param[0]) {
                      // FALLTHROUGH
                      case 0:
                        $f = $param[1];
                        return $call1($f, 0);
                      // FALLTHROUGH
                      case 1:
                        $f__0 = $param[1];
                        $arg = $get_arg(0);
                        $match = $bool_of_string_opt($arg);
                        if ($match) {
                          $s__0 = $match[1];
                          $call1($f__0, $s__0);
                          return $consume_arg(0);
                        }
                        throw $runtime["caml_wrap_thrown_exception"](
                                Vector{0, $Stop, Vector{1, $s, $arg, $cst_a_boolean}}
                              ) as \Throwable;
                      // FALLTHROUGH
                      case 2:
                        $r = $param[1];
                        $no_arg(0);
                        $r[1] = 1;
                        return 0;
                      // FALLTHROUGH
                      case 3:
                        $r__0 = $param[1];
                        $no_arg(0);
                        $r__0[1] = 0;
                        return 0;
                      // FALLTHROUGH
                      case 4:
                        $f__1 = $param[1];
                        $arg__0 = $get_arg(0);
                        $call1($f__1, $arg__0);
                        return $consume_arg(0);
                      // FALLTHROUGH
                      case 5:
                        $r__1 = $param[1];
                        $r__1[1] = $get_arg(0);
                        return $consume_arg(0);
                      // FALLTHROUGH
                      case 6:
                        $f__2 = $param[1];
                        $arg__1 = $get_arg(0);
                        $match__0 = $int_of_string_opt($arg__1);
                        if ($match__0) {
                          $x = $match__0[1];
                          $call1($f__2, $x);
                          return $consume_arg(0);
                        }
                        throw $runtime["caml_wrap_thrown_exception"](
                                Vector{0, $Stop, Vector{1, $s, $arg__1, $cst_an_integer}}
                              ) as \Throwable;
                      // FALLTHROUGH
                      case 7:
                        $r__2 = $param[1];
                        $arg__2 = $get_arg(0);
                        $match__1 = $int_of_string_opt($arg__2);
                        if ($match__1) {
                          $x__0 = $match__1[1];
                          $r__2[1] = $x__0;
                          return $consume_arg(0);
                        }
                        throw $runtime["caml_wrap_thrown_exception"](
                                Vector{0, $Stop, Vector{1, $s, $arg__2, $cst_an_integer__0}}
                              ) as \Throwable;
                      // FALLTHROUGH
                      case 8:
                        $f__3 = $param[1];
                        $arg__3 = $get_arg(0);
                        $match__2 = $float_of_string_opt($arg__3);
                        if ($match__2) {
                          $x__1 = $match__2[1];
                          $call1($f__3, $x__1);
                          return $consume_arg(0);
                        }
                        throw $runtime["caml_wrap_thrown_exception"](
                                Vector{0, $Stop, Vector{1, $s, $arg__3, $cst_a_float}}
                              ) as \Throwable;
                      // FALLTHROUGH
                      case 9:
                        $r__3 = $param[1];
                        $arg__4 = $get_arg(0);
                        $match__3 = $float_of_string_opt($arg__4);
                        if ($match__3) {
                          $x__2 = $match__3[1];
                          $r__3[1] = $x__2;
                          return $consume_arg(0);
                        }
                        throw $runtime["caml_wrap_thrown_exception"](
                                Vector{0, $Stop, Vector{1, $s, $arg__4, $cst_a_float__0}}
                              ) as \Throwable;
                      // FALLTHROUGH
                      case 10:
                        $specs = $param[1];
                        return $call2($List[15], $treat_action->contents, $specs);
                      // FALLTHROUGH
                      case 11:
                        $f__4 = $param[2];
                        $symb = $param[1];
                        $arg__5 = $get_arg(0);
                        if ($call2($List[31], $arg__5, $symb)) {
                          $call1($f__4, $arg__5);
                          return $consume_arg(0);
                        }
                        $n4 = $make_symlist($cst__5, $cst__4, $cst__3, $symb);
                        throw $runtime["caml_wrap_thrown_exception"](
                                Vector{
                                  0,
                                  $Stop,
                                  Vector{
                                    1,
                                    $s,
                                    $arg__5,
                                    $call2($Pervasives[16], $cst_one_of, $n4)
                                  }
                                }
                              ) as \Throwable;
                      // FALLTHROUGH
                      case 12:
                        $f__5 = $param[1];
                        for (;;) {
                          if ($current[1] < (int) ($argv[1]->count() - 1 + -1)) {
                            $n5 = (int) ($current[1] + 1);
                            $call1($f__5, $caml_check_bound($argv[1], $n5)[$n5 + 1]);
                            $consume_arg(0);
                            continue;
                          }
                          return 0;
                        }
                      // FALLTHROUGH
                      default:
                        $f__6 = $param[1];
                        if (1 - $allow_expand) {
                          throw $runtime["caml_wrap_thrown_exception"](
                                  Vector{
                                    0,
                                    $Invalid_argument,
                                    $cst_Arg_Expand_is_is_only_allowed_with_Arg_parse_and_expand_argv_dynamic
                                  }
                                ) as \Throwable;
                        }
                        $arg__6 = $get_arg(0);
                        $newarg = $call1($f__6, $arg__6);
                        $consume_arg(0);
                        $before = $call3(
                          $Array[7],
                          $argv[1],
                          0,
                          (int)
                          ($current[1] + 1)
                        );
                        $after = $call3(
                          $Array[7],
                          $argv[1],
                          (int)
                          ($current[1] + 1),
                          (int)
                          ((int) ($argv[1]->count() - 1 - $current[1]) + -1)
                        );
                        $argv[1] =
                          $call1(
                            $Array[6],
                            Vector{0, $before, Vector{0, $newarg, Vector{0, $after, 0}}}
                          );
                        return 0;
                      }
                  };
                  return $treat_action->contents;
                };
                $treat_action = $treat_action__0(
                  $s,
                  $no_arg,
                  $get_arg,
                  $consume_arg
                );
                $treat_action($action);
                $switch__0 = 1;
              }
              else {$switch__0 = 0;}
            }
            else {$switch__0 = 0;}
            if (! $switch__0) {$call1($anonfun, $s);}
          }
          catch(\Throwable $exn) {
            $exn = $caml_wrap_exception($exn);
            if ($exn[1] === $Bad) {
              $m = $exn[2];
              throw $runtime["caml_wrap_thrown_exception"]($convert_error(Vector{3, $m})) as \Throwable;
            }
            if ($exn[1] === $Stop) {
              $e = $exn[2];
              throw $runtime["caml_wrap_thrown_exception"]($convert_error($e)) as \Throwable;
            }
            throw $runtime["caml_wrap_thrown_exception_reraise"]($exn) as \Throwable;
          }
          $current[1] += 1;
          continue;
        }
        return 0;
      }
    };
    $parse_and_expand_argv_dynamic = function
    (dynamic $current, dynamic $argv, dynamic $speclist, dynamic $anonfun, dynamic $errmsg) use ($parse_and_expand_argv_dynamic_aux) {
      return $parse_and_expand_argv_dynamic_aux(
        1,
        $current,
        $argv,
        $speclist,
        $anonfun,
        $errmsg
      );
    };
    $parse_argv_dynamic = function
    (dynamic $opt, dynamic $argv, dynamic $speclist, dynamic $anonfun, dynamic $errmsg) use ($current,$parse_and_expand_argv_dynamic_aux) {
      if ($opt) {
        $sth = $opt[1];
        $current__0 = $sth;
      }
      else {$current__0 = $current;}
      return $parse_and_expand_argv_dynamic_aux(
        0,
        $current__0,
        Vector{0, $argv},
        $speclist,
        $anonfun,
        $errmsg
      );
    };
    $parse_argv = function
    (dynamic $opt, dynamic $argv, dynamic $speclist, dynamic $anonfun, dynamic $errmsg) use ($current,$parse_argv_dynamic) {
      if ($opt) {
        $sth = $opt[1];
        $current__0 = $sth;
      }
      else {$current__0 = $current;}
      return $parse_argv_dynamic(
        Vector{0, $current__0},
        $argv,
        Vector{0, $speclist},
        $anonfun,
        $errmsg
      );
    };
    $parse = function(dynamic $l, dynamic $f, dynamic $msg) use ($Bad,$Help,$Pervasives,$Printf,$Sys,$call1,$call2,$caml_wrap_exception,$nn,$no,$parse_argv,$runtime) {
      try {$n0 = $parse_argv(0, $Sys[1], $l, $f, $msg);return $n0;}
      catch(\Throwable $exn) {
        $exn = $caml_wrap_exception($exn);
        if ($exn[1] === $Bad) {
          $msg__0 = $exn[2];
          $call2($Printf[3], $nn, $msg__0);
          return $call1($Pervasives[87], 2);
        }
        if ($exn[1] === $Help) {
          $msg__1 = $exn[2];
          $call2($Printf[2], $no, $msg__1);
          return $call1($Pervasives[87], 0);
        }
        throw $runtime["caml_wrap_thrown_exception_reraise"]($exn) as \Throwable;
      }
    };
    $parse_dynamic = function(dynamic $l, dynamic $f, dynamic $msg) use ($Bad,$Help,$Pervasives,$Printf,$Sys,$call1,$call2,$caml_wrap_exception,$np,$nq,$parse_argv_dynamic,$runtime) {
      try {$nZ = $parse_argv_dynamic(0, $Sys[1], $l, $f, $msg);return $nZ;}
      catch(\Throwable $exn) {
        $exn = $caml_wrap_exception($exn);
        if ($exn[1] === $Bad) {
          $msg__0 = $exn[2];
          $call2($Printf[3], $np, $msg__0);
          return $call1($Pervasives[87], 2);
        }
        if ($exn[1] === $Help) {
          $msg__1 = $exn[2];
          $call2($Printf[2], $nq, $msg__1);
          return $call1($Pervasives[87], 0);
        }
        throw $runtime["caml_wrap_thrown_exception_reraise"]($exn) as \Throwable;
      }
    };
    $parse_expand = function(dynamic $l, dynamic $f, dynamic $msg) use ($Bad,$Help,$Pervasives,$Printf,$Sys,$call1,$call2,$caml_wrap_exception,$current,$nr,$ns,$parse_and_expand_argv_dynamic,$runtime) {
      try {
        $argv = Vector{0, $Sys[1]};
        $spec = Vector{0, $l};
        $current__0 = Vector{0, $current[1]};
        $nY = $parse_and_expand_argv_dynamic(
          $current__0,
          $argv,
          $spec,
          $f,
          $msg
        );
        return $nY;
      }
      catch(\Throwable $exn) {
        $exn = $caml_wrap_exception($exn);
        if ($exn[1] === $Bad) {
          $msg__0 = $exn[2];
          $call2($Printf[3], $nr, $msg__0);
          return $call1($Pervasives[87], 2);
        }
        if ($exn[1] === $Help) {
          $msg__1 = $exn[2];
          $call2($Printf[2], $ns, $msg__1);
          return $call1($Pervasives[87], 0);
        }
        throw $runtime["caml_wrap_thrown_exception_reraise"]($exn) as \Throwable;
      }
    };
    $second_word = function(dynamic $s) use ($Not_found,$String,$call2,$caml_ml_string_length,$caml_string_get,$caml_wrap_exception,$runtime) {
      $len = $caml_ml_string_length($s);
      $loop = function(dynamic $n) use ($caml_string_get,$len,$s) {
        $n__0 = $n;
        for (;;) {
          if ($len <= $n__0) {return $len;}
          if (32 === $caml_string_get($s, $n__0)) {
            $n__1 = (int) ($n__0 + 1);
            $n__0 = $n__1;
            continue;
          }
          return $n__0;
        }
      };
      try {$n__0 = $call2($String[14], $s, 9);}
      catch(\Throwable $nW) {
        $nW = $caml_wrap_exception($nW);
        if ($nW === $Not_found) {
          try {$n = $call2($String[14], $s, 32);}
          catch(\Throwable $nX) {
            $nX = $caml_wrap_exception($nX);
            if ($nX === $Not_found) {return $len;}
            throw $runtime["caml_wrap_thrown_exception_reraise"]($nX) as \Throwable;
          }
          return $loop((int) ($n + 1));
        }
        throw $runtime["caml_wrap_thrown_exception_reraise"]($nW) as \Throwable;
      }
      return $loop((int) ($n__0 + 1));
    };
    $max_arg_len = function(dynamic $cur, dynamic $param) use ($Pervasives,$call2,$caml_ml_string_length,$second_word) {
      $doc = $param[3];
      $spec = $param[2];
      $kwd = $param[1];
      if (11 === $spec[0]) {
        return $call2($Pervasives[5], $cur, $caml_ml_string_length($kwd));
      }
      $nV = (int) ($caml_ml_string_length($kwd) + $second_word($doc));
      return $call2($Pervasives[5], $cur, $nV);
    };
    $replace_leading_tab = function(dynamic $s) use ($String,$call2) {
      $seen = Vector{0, 0};
      $nU = function(dynamic $c) use ($seen) {
        if (9 === $c) {if (! $seen[1]) {$seen[1] = 1;return 32;}}
        return $c;
      };
      return $call2($String[10], $nU, $s);
    };
    $add_padding = function(dynamic $len, dynamic $ksd) use ($Pervasives,$String,$call2,$call3,$caml_ml_string_length,$caml_string_notequal,$cst__6,$cst__7,$replace_leading_tab,$second_word) {
      $nN = $ksd[2];
      $nO = $ksd[1];
      if ($caml_string_notequal($ksd[3], $cst__6)) {
        if (11 === $nN[0]) {
          $msg__0 = $ksd[3];
          $cutcol__0 = $second_word($msg__0);
          $nR = (int)
          ($call2($Pervasives[5], 0, (int) ($len - $cutcol__0)) + 3);
          $spaces__0 = $call2($String[1], $nR, 32);
          $nS = $replace_leading_tab($msg__0);
          $nT = $call2($Pervasives[16], $spaces__0, $nS);
          return Vector{0, $nO, $nN, $call2($Pervasives[16], $cst__7, $nT)};
        }
        $msg = $ksd[3];
        $cutcol = $second_word($msg);
        $kwd_len = $caml_ml_string_length($nO);
        $diff = (int) ((int) ($len - $kwd_len) - $cutcol);
        if (0 < $diff) {
          $spaces = $call2($String[1], $diff, 32);
          $nP = $replace_leading_tab($msg);
          $prefix = $call3($String[4], $nP, 0, $cutcol);
          $suffix = $call3(
            $String[4],
            $msg,
            $cutcol,
            (int)
            ($caml_ml_string_length($msg) - $cutcol)
          );
          $nQ = $call2($Pervasives[16], $spaces, $suffix);
          return Vector{0, $nO, $nN, $call2($Pervasives[16], $prefix, $nQ)};
        }
        return Vector{0, $nO, $nN, $replace_leading_tab($msg)};
      }
      return $ksd;
    };
    $align = function(dynamic $opt, dynamic $speclist) use ($List,$Pervasives,$add_help,$add_padding,$call2,$call3,$max_arg_len) {
      if ($opt) {
        $sth = $opt[1];
        $limit = $sth;
      }
      else {$limit = $Pervasives[7];}
      $completed = $add_help($speclist);
      $len = $call3($List[20], $max_arg_len, 0, $completed);
      $len__0 = $call2($Pervasives[4], $len, $limit);
      $nL = function(dynamic $nM) use ($add_padding,$len__0) {
        return $add_padding($len__0, $nM);
      };
      return $call2($List[17], $nL, $completed);
    };
    $trim_cr = function(dynamic $s) use ($String,$call3,$caml_ml_string_length,$caml_string_get) {
      $len = $caml_ml_string_length($s);
      if (0 < $len) {
        if (13 === $caml_string_get($s, (int) ($len + -1))) {
          return $call3($String[4], $s, 0, (int) ($len + -1));
        }
      }
      return $s;
    };
    $read_aux = function(dynamic $trim, dynamic $sep, dynamic $file) use ($Array,$Buffer,$End_of_file,$List,$Pervasives,$call1,$call2,$caml_wrap_exception,$runtime,$trim_cr) {
      $read = new Ref();
      $ic = $call1($Pervasives[68], $file);
      $buf = $call1($Buffer[1], 200);
      $words = Vector{0, 0};
      $stash = function(dynamic $param) use ($Buffer,$buf,$call1,$trim,$trim_cr,$words) {
        $word = $call1($Buffer[2], $buf);
        $word__0 = $trim ? $trim_cr($word) : ($word);
        $words[1] = Vector{0, $word__0, $words[1]};
        return $call1($Buffer[8], $buf);
      };
      $read->contents = function(dynamic $param) use ($Buffer,$End_of_file,$Pervasives,$buf,$call1,$call2,$caml_wrap_exception,$ic,$read,$runtime,$sep,$stash) {
        try {
          $c = $call1($Pervasives[70], $ic);
          if ($c === $sep) {
            $stash(0);
            $nJ = $read->contents(0);
          }
          else {$call2($Buffer[10], $buf, $c);$nJ = $read->contents(0);}
          return $nJ;
        }
        catch(\Throwable $nK) {
          $nK = $caml_wrap_exception($nK);
          if ($nK === $End_of_file) {
            $nI = 0 < $call1($Buffer[7], $buf) ? 1 : (0);
            return $nI ? $stash(0) : ($nI);
          }
          throw $runtime["caml_wrap_thrown_exception_reraise"]($nK) as \Throwable;
        }
      };
      $read->contents(0);
      $call1($Pervasives[81], $ic);
      $nH = $call1($List[9], $words[1]);
      return $call1($Array[12], $nH);
    };
    $nt = 10;
    $nu = 1;
    $read_arg = function(dynamic $nG) use ($nt,$nu,$read_aux) {
      return $read_aux($nu, $nt, $nG);
    };
    $nv = 0;
    $nw = 0;
    $read_arg0 = function(dynamic $nF) use ($nv,$nw,$read_aux) {
      return $read_aux($nw, $nv, $nF);
    };
    $write_aux = function(dynamic $sep, dynamic $file, dynamic $args) use ($Array,$Pervasives,$Printf,$call1,$call2,$call4,$nx) {
      $oc = $call1($Pervasives[49], $file);
      $nE = function(dynamic $s) use ($Printf,$call4,$nx,$oc,$sep) {
        return $call4($Printf[1], $oc, $nx, $s, $sep);
      };
      $call2($Array[13], $nE, $args);
      return $call1($Pervasives[64], $oc);
    };
    $ny = 10;
    $write_arg = function(dynamic $nC, dynamic $nD) use ($ny,$write_aux) {
      return $write_aux($ny, $nC, $nD);
    };
    $nz = 0;
    $write_arg0 = function(dynamic $nA, dynamic $nB) use ($nz,$write_aux) {
      return $write_aux($nz, $nA, $nB);
    };
    $Arg = Vector{
      0,
      $parse,
      $parse_dynamic,
      $parse_argv,
      $parse_argv_dynamic,
      $parse_and_expand_argv_dynamic,
      $parse_expand,
      $Help,
      $Bad,
      $usage,
      $usage_string,
      $align,
      $current,
      $read_arg,
      $read_arg0,
      $write_arg,
      $write_arg0
    };
    
    $runtime["caml_register_global"](58, $Arg, "Arg");

  }
}