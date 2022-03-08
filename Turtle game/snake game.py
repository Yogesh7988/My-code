import turtle
import time
import random

delay=0.1

score=0
high_score=0

w=turtle.Screen()
w.title('Snake game')
w.bgcolor('green')
w.setup(width=600,height=600)
w.tracer(0)

h=turtle.Turtle()
h.speed(0)
h.shape('circle')
h.color('black')
h.penup()
h.goto(0,0)
h.direction='stop'


f=turtle.Turtle()
f.speed(0)
f.shape('square')
f.color('red')
f.penup()
f.goto(0,100)

segments=[]

pen=turtle.Turtle()
pen.speed(0)
pen.shape('square')
pen.color('white')
pen.penup()
pen.hideturtle()
pen.goto(0,260)
pen.write('Score:0  High Score:0',align='center',font=('courier',24,'normal'))

def move():
    if h.direction =='up':
        y=h.ycor()
        h.sety(y+20)
    if h.direction =='down':
        y=h.ycor()
        h.sety(y-20)
    if h.direction =='left':
        x=h.xcor()
        h.setx(x-20)
    if h.direction =='right':
        x=h.xcor()
        h.setx(x+20)

def go_up():
    if h.direction !='down':
       h.direction='up'

def go_down():
    if h.direction !='up':
       h.direction='down'

def go_left():
    if h.direction !='right':
       h.direction='left'

def go_right():
    if h.direction !='left':
       h.direction='right'

w.listen()
w.onkeypress(go_up,'w')
w.onkeypress(go_down,'s')
w.onkeypress(go_left,'a')
w.onkeypress(go_right,'d')


while True:
    w.update()

    if h.xcor()>290 or h.xcor()<-290 or h.ycor()>290 or h.ycor()>290:
        time.sleep(1)
        h.goto(0,0)
        h.direction='stop'

        for segment in segments:
            segment.goto(1000,1000)
        
        segments.clear()

        delay=0.1

        score=0
        pen.clear()
        pen.write('Score: {}  High Score: {}'.format(score,high_score),align='center',font=('courier',24,'normal'))


    if h.distance(f) <20:
        x=random.randint(-290,290)
        y=random.randint(-290,290)
        f.goto(x,y)

        new_segment=turtle.Turtle()
        new_segment.speed(0)
        new_segment.shape('square')
        new_segment.color('grey')
        new_segment.penup()
        segments.append(new_segment)

        delay-=0.001
        
        score+=10

        if score>high_score:
            high_score=score

        pen.clear()
        pen.write('Score: {}  High Score: {}'.format(score,high_score),align='center',font=('courier',24,'normal'))


    for index in range(len(segments)-1,0,-1):
        x=segments[index-1].xcor()
        y=segments[index-1].ycor()
        segments[index].goto(x,y)

    if len(segments)>0:
        x=h.xcor()
        y=h.ycor()
        segments[0].goto(x,y)


    move()

    for segment in segments:
        if segment.distance(h)<20:
            time.sleep(1)
            h.goto(0,0)
            h.direction='stop'

            for segment in segments:
                segment.goto(1000,1000)
        
            segments.clear()
            score=0
            delay=0.1
            pen.clear()
            pen.write('Score: {}  High Score: {}'.format(score,high_score),align='center',font=('courier',24,'normal'))

    time.sleep(delay)

w.mainloop()