import json
import urllib

queries = [
    {'q': '160-1030-ND',
     'reference': 'line1'}
    ]

url = 'http://octopart.com/api/v3/parts/match?queries=%s' \
    % urllib.quote(json.dumps(queries))

print(urllib.quote(json.dumps(queries)))
print(json.dumps(queries))