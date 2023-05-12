particlesJS(
  'js-particles', {
    'particles': {
      'number': {
        'value': 300
      },
      'color': {
        'value': ['#ffff00','#ff0000', '#0000ff', '#00ff00', '#8000ff', '#00e3ff', 'fc00ff']
      },
      'shape': {
        'type':  ["circle","square","polygon", "star"],
      },
      'opacity': {
        'value': 1,
        'random': false,
        'anim': {
          'enable': true
        }
      },
      'size': {
        'value': 3,
        'random': true,
        'anim': {
          'enable': true,
        }
      },
      'line_linked': {
        'enable': false
      },
      'move': {
        'enable': true,
        'speed': 2,
        'direction': 'none',
        'random': true,
        'straight': false,
        'out_mode': 'out'
      }
    },
    'interactivity': {
      'detect_on': 'canvas',
      'events': {
        'onhover': {
          'enable': false
        },
        'onclick': {
          'enable': false
        },
        'resize': true
      }
    },
    'retina_detect': true
});