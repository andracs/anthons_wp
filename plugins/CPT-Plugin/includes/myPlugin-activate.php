<?php
class MyPluginActivate
{
  public static function activate()
  {
    flush_rewrite_rules();
  }
}
