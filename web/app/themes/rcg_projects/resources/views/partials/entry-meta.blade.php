<time class="updated" datetime="{{ get_post_time('c', true) }}">
  {{ get_the_date() }}
</time>

<p class="byline author vcard">
  <span>{{ __('By', 'sage') }}</span>
  <span class="author" itemprop="author" itemscope itemtype="http://schema.org/Person">
  <a href="@authorurl" itemprop="url">
    <span class="fn" itemprop="name" rel="author">@author</span>
  </a>
</span>
</p>
