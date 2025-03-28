<?php

namespace Hytmng\PhpGenerator;

/**
 * 定数を共通化するためのクラス
 */
final class Symbol
{
    // 名前空間の区切り文字
    public const NAMESPACE_SEPARATOR = '\\';
    // 変数
    public const VAR = '$';
    // セミコロン
    public const SEMICOLON = ';';
    // スペース
    public const SPACE = ' ';
    // インラインコメント
    public const COMMENT_INLINE = '// ';
    // マルチラインコメント(開始)
    public const COMMENT_MULTILINE_START = '/**';
    // マルチラインコメント(内容)
    public const COMMENT_MULTILINE_CONTENT = ' * ';
    // マルチラインコメント(終了)
    public const COMMENT_MULTILINE_END = ' */';

}
