<?php

namespace Framework\router\enums;

enum HttpMethods: string
{
    case GET = "GET";
    case POST = "POST";
    case PUT = "PUT";
    case PATH = "PATH";
    case DELETE = "DELETE";
}