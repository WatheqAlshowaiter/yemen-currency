<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\View\View;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\MarkdownConverter;

class PrivacyPolicyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): View
    {
        // Path to the markdown file
        $markdownPath = resource_path('markdown/privacy-policy.md');

        // Read the markdown content
        $markdownContent = File::get($markdownPath);

        // Configure the markdown converter
        $environment = new Environment([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);
        $environment->addExtension(new CommonMarkCoreExtension());

        $converter = new MarkdownConverter($environment);

        // Convert markdown to HTML
        $htmlContent = $converter->convert($markdownContent)->getContent();

        return view('privacy-policy', [
            'content' => $htmlContent,
        ]);
    }
}
