<?php
/**
 * Description of class
 *
 * @author jds
 */
class dbg
{
    function __construct()
    {}
    public function msg($message, $method='', $exception=false, $file='', $line='')
    {
        print "<div class='err'>";
        $method=='' ? print '' : print "<span style='color:red;'>$method</span>: ";
        print "<span style='color:black'>$message";
        $file=='' ? print '' : print "in file $file";
        $line=='' ? print '' : print "on line $line";
        print "</span></div>";
        if($exception) throw Exception ($msg);
    }
    public function vardump($var, $label='')
    {
        $dump = var_export($var, true);
        print "<div class='err'>";
        $label=='' ? print '' : print "<span style='color:red;'>$label</span>: ";
        print "<span style='color:black;'>$dump</span></div>";
    }
    public function test($term, $method='', $fail='false') {
        print "<div>PRINT</div>";
        dbg::msg("message");
        assert_options(ASSERT_ACTIVE, true);
        print "<div>ASSERT_ACTIVE</div>";
        assert_options(ASSERT_WARNING, true);
        print "<div>ASSERT_WARNING</div>";
        assert_options(ASSERT_BAIL, false);
        print "<div>ASSERT_BAIL</div>";
        assert_options(ASSERT_QUIET_EVAL, false);
        print "<div>ASSERT_QUIET_EVAL</div>";
        assert_callback(ASSERT_CALLBACK, 'dbg::testFail');
        print "<div>ASSERT_CALLBACK</div>";

        assert($term);
        print "ASSERTED";
        //if(!assert($term)) dbg::msg("ASSERTION: $term is false",$method, $fail);
        //else dbg::msg("Asserted $term.");
    }
    private function testFail() {
        dbg::msg("Assertion Failed");
    }
    public function setNoCache() {
        print "<META HTTP-EQUIV='CACHE-CONTROL' CONTENT='NO-CACHE'>\n<META HTTP-EQUIV='PRAGMA' CONTENT='NO-CACHE'>";
    }
}
?>
