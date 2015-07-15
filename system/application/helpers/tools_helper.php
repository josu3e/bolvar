<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5 or newer
 *
 * @package		CodeIgniter
 * @author		GSP development team.
 * @copyright	Copyright (c) 2010, EllisLab, Inc.
 * @license		http://guramistudios.com/user_guide/license.html
 * @link		http://guramistudios.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Tools Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/date_helper.html
 */

// ------------------------------------------------------------------------

/**
 * Get "friendly_url" time
 *
 * Returns a friendly url
 *
 * @access	public
 * @return	string
 */
if ( ! function_exists('friendly_url'))
{
  function friendly_url($url) {
    // Tranformamos todo a minusculas
    $url = strtolower($url);
    //Rememplazamos caracteres especiales latinos
    $find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
    $repl = array('a', 'e', 'i', 'o', 'u', 'n');
    $url = str_replace ($find, $repl, $url);
    // Añaadimos los guiones
    $find = array(' ', '&', '\r\n', '\n', '+');
    $url = str_replace ($find, '-', $url);
    // Eliminamos y Reemplazamos demás caracteres especiales
    $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
    $repl = array('', '_', '');
    $url = preg_replace ($find, $repl, $url);
    return $url;
  }
}

/**
 * Get "date_mysql_web" time
 *
 * Returns a friendly url
 *
 * @access	public
 * @return	string
 */
if ( ! function_exists('date_mysql_web'))
{
  function date_mysql_web($date='') {
    $date = ($date=='')?date('Y-m-d'):$date;
    list($y,$m,$d) = explode('-', $date);
    return $d.'/'.$m.'/'.$y;
  }
}

/**
 * Get "date_web_mysql" time
 *
 * Returns a friendly url
 *
 * @access	public
 * @return	string
 */
if ( ! function_exists('date_web_mysql'))
{
  function date_web_mysql($date='') {
    $date = ($date=='')?date('d/m/Y'):$date;
    list($d,$m,$y) = explode('/', $date);
    return $y.'-'.$m.'-'.$d;
  }
}

/**
 * Get "date_add_day" time
 *
 * Returns a new date
 *
 * @access	public
 * @return	string
 */
if ( ! function_exists('date_add_day'))
{
  function date_add_day($date, $dia){
    list($year,$mon,$day) = explode('-',$date);
    return date('Y-m-d',mktime(0,0,0,$mon,$day+$dia,$year));
  }
}

/**
 * Get "date_add_month" time
 *
 * Returns a new date
 *
 * @access	public
 * @return	string
 */
if ( ! function_exists('date_add_month'))
{
  function date_add_month($date, $mes){
    list($year,$mon,$day) = explode('-',$date);
    return date('Y-m-d',mktime(0,0,0,$mon+$mes,$day,$year));
  }
}
/* End of file date_helper.php */
/* Location: ./system/helpers/date_helper.php */