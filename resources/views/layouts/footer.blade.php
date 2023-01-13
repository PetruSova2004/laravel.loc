<footer class="text-muted">
    <div class="container">
        <p class="float-right">
            <a href="#">Back to top</a>
        </p>
        <p>&copy; {{ date('Y') }}</p>
        <p>New to Bootstrap? <a href="https://getbootstrap.com/">Visit the homepage</a> or read our <a
                href="/docs/4.5/getting-started/introduction/">getting started guide</a>.</p>

        <ul>
            @foreach($rubrics as $rubric)
                <li>{{$rubric->title}}</li>
            @endforeach
        </ul>

    </div>
</footer>
