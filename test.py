from math import pow
def rel_lum(color):
r = int(color[1:3], 16)/255
g = int(color[3:5], 16)/255
b = int(color[5:7], 16)/255
def comp(c):
return c/12.92 if c <= 0.03928 else ((c+0.055)/1.055)**2.4
R, G, B = map(comp, (r, g, b))
return 0.2126R + 0.7152G + 0.0722*B

def contrast_ratio(hex1, hex2):
l1, l2 = rel_lum(hex1), rel_lum(hex2)
if l1 < l2:
l1, l2 = l2, l1
return (l1 + 0.05) / (l2 + 0.05)

bg = '#033D28'
for fg in ('#0FB36D', '#F8F9FA'):
print(f"Contrast ratio for {fg} on {bg}: {contrast_ratio(fg, bg):.2f}:1")